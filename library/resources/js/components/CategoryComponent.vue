<template>
  <div>
    <form class="col s12" method="POST">
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix">bookmark_border</i>
          <input
            v-model="categoryName"
            id="icon_prefix"
            type="text"
            class="validate"
          />
          <label for="icon_prefix">Category name</label>
        </div>
        <div class="input-field col s5">
          <i class="material-icons prefix">description</i>
          <input
            v-model="categoryDescription"
            id="icon_description"
            type="text"
            class="validate"
          />
          <label for="icon_description">Category description</label>
        </div>
        <div class="input-field col s2 left">
          <a
            v-on:click="saveCategory()"
            class="btn-floating btn-large waves-effect waves-light red left"
            ><i class="material-icons">add</i></a
          >
        </div>
      </div>
    </form>
    <ul class="collection with-header">
      <li class="collection-header">
        <h4>Registered categories</h4>
      </li>
      <li
        v-for="category in categoryArray"
        :key="category.id"
        class="collection-item"
      >
        <a href="#!" class="secondary-content"
          ><i class="material-icons">bookmark_border</i>
        </a>
        <h5>{{ category.name }}</h5>
        <p>{{ category.description }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Category",
  /**
   *   Este método carga los servicios REST. se utiliza la biblioteca 'axios'.
   *   Investigar acerca de axios para ver su implementación
   */
  created() {
    axios
      .get("/getCategory")
      .then((response) => (this.categoryArray = response.data));
  },

  data() {
    return {
      categoryArray: [],
      categoryName: "",
      categoryDescription: "",
    };
  },

  methods: {
    saveCategory: function () {
      axios
        .post("/saveCategory", {
          name: this.categoryName,
          description: this.categoryDescription,
        })
        .then((response) => (location.reload()));
    },
  },
};
</script>
