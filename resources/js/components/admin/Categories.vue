<template>
  <div>
      <form class="mb-3" @submit.prevent="addCategory">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Title"
          v-model="category.title">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Slug"
          v-model="category.slug">
        </div>
        <div class="form-group">
          <textarea type="text" class="form-control" placeholder="Description goes here"
          v-model="category.description"></textarea>
        </div>
        <button type="submit" class="btn btn-success btn-lrg">Create</button>
      </form>
    <nav aria-label="Categories Page Navigation">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]"
        class="page-item"><a href="#" class="page-link"
        @click="fetchCategories(pagination.prev_page_url)">
        Previous</a></li>

        <li class="page-item disabled"><a href="#" class="page-link dark-text">Page {{ pagination.current_page }} of {{pagination.last_page}}</a></li>


        <li v-bind:class="[{disabled: !pagination.next_page_url}]"
        class="page-item"><a href="#" class="page-link"
        @click="fetchCategories(pagination.next_page_url)">
        Next</a></li>
      </ul>
    </nav>

    <div class="card"v-for="category in categories" v-bind:key="category.id">
      <div class="card card-header text-white bg-primary">
        <h3 class="mb-0">{{ category.title }} | <small>{{category.id}}</small>
        <a @click="deleteCategory(category.id)" class="collapse-link cursor-pointer">
          <i  class="fa fa-times float-right ml-3"></i>
        </a>
        <a @click="editCategory(category)" class="collapse-link cursor-pointer">
          <i class="fa fa-wrench float-right"></i>
        </a>
        </h3>
      </div>
      <div class="card-body">
        <small><u><strong>Slug:</strong></u> {{ category.slug }}</small></p>
        <p><u><strong>Description:</strong></u> {{ category.description }}</p>
      </div>
    </div>

  </div>
</template>
<script>
  export default {
    data() {
      return {
        categories: [],
        category: {
          id: '',
          title: '',
          slug: '',
          description: ''
        },
        category_id: '',
        pagination: {},
        edit: false
      }
    },

    created(){
      this.fetchCategories();
    },

    methods: {
      fetchCategories(page_url){
        let vm = this;
        page_url = page_url || 'api/categories'
        fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.categories = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
      },
      makePagination(meta, links) {
        let pagination = {
          current_page: meta.current_page,
          last_page: meta.last_page,
          next_page_url: links.next,
          prev_page_url: links.prev
        };
        this.pagination = pagination;
      },
      deleteCategory(id) {
        if (confirm('Are You Sure you want to delete category id '+id+'?')) {
          fetch(`api/category/${id}`, {
            method: 'delete'
          })
            .then(res => res.json())
            .then(data => {
              alert('Category Removed');
              this.fetchCategories();
            })
            .catch(err => console.log(err));
        }
      },
      addCategory() {
        if (this.edit === false) {
          // Add
          fetch('api/category', {
            method: 'post',
            body: JSON.stringify(this.category),
            headers: {
              'content-type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.category.title = '';
            this.category.slug = '';
            this.category.description = '';
            alert('category Added');
            this.fetchCategories();
          })
          .catch(err => console.log(err));
        } else {
          // Update
          fetch('api/category', {
            method: 'put',
            body: JSON.stringify(this.category),
            headers: {
              'content-type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.category.title = '';
            this.category.slug = '';
            this.category.description = '';
            alert('category * Updated');
            this.fetchCategories();
          })
          .catch(err => console.log(err));
        }
      },
      editCategory(category) {
        this.edit=true;
        this.category.id = category.id;
        this.category.category_id = category.id;
        this.category.title = category.title;
        this.category.slug = category.slug;
        this.category.description = category.description;
        // document.body.scrollTop = document.documentElement.scrollTop = 0;
        window.scroll({
         top: 0,
         left: 0,
         behavior: 'smooth'
        });

      }
    }
  }
</script>
