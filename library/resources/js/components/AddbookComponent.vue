<template>
  <form method="POST">
    <h4 class="header center">Add a book</h4>
    <div class="row">
      <div class="input-field col s10">
        <i class="material-icons prefix">book</i>
        <input
          v-model="name"
          id="icon_book_name"
          type="text"
          class="validate"
        />
        <label for="icon_book_name">Book name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s10">
        <i class="material-icons prefix">person_pin</i>
        <input v-model="author" id="icon_author" type="text" class="validate" />
        <label for="icon_author">Book author</label>
      </div>
    </div>
    <div class="row">
        <div class="input-field col s10">
        <i class="material-icons prefix">bookmark_border</i>
        <input
          v-model="category"
          id="icon_prefix"
          type="text"
          class="validate"
        />
        <label for="icon_prefix">Category</label>
      </div>
    </div>
    <div class="row">
            <div class="input-field col s10">
        <i class="material-icons prefix">date_range</i>
        <input
          v-model="published"
          id="icon_published"
          type="date"
        />
        <label for="icon_published">Published date</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s2 left">
        <a
          v-on:click="saveBook()"
          class="btn-floating btn-large waves-effect waves-light red right"
          ><i class="material-icons">add</i></a
        >
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  name: "Addbook",

  data() {
    return {
      name: "",
      category: "",
      author: "",
      published: "",
      categoriesArray: [],
      categoriasFiltradas: [],
    };
  },

  created() {
    axios
      .get("/getCategory")
      .then((response) => (this.categoriesArray = response.data));
  },

  methods: {
    saveBook: function () {
      axios
      .post("/saveBook", {
          name: this.name,
          author: this.author,
          published_date: this.published,
          available: 1,
          category_id: this.devuelveIdCategoria(this.category),
      })
      .then((response) => (location.reload()));
    },

    devuelveIdCategoria: function(categoriaTxt) {
        for (let index = 0; index < this.categoriesArray.length; index++) {
            console.log("en: " + index + ", el valor de categoriesArray.name es: " + this.categoriesArray[index].name);
            if(this.categoriesArray[index].name == categoriaTxt) {
                return this.categoriesArray[index].id;
            }
        }
        return 1;
    }
  },

  computed: {
    filtraCategorias: function () {
      return this.categoriesFiltradas.filter((categoriesArray) =>
        categoriesArray.name.includes(this.category)
      );
    },
  },
};
</script>
