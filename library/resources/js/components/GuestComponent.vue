<template>
  <div>
    <form class="col s12" method="POST">
      <div class="row">
        <div class="input-field col s10">
          <i class="material-icons prefix">account_circle</i>
          <input v-model="guest" id="icon_prefix" type="text" class="validate" />
          <label for="icon_prefix">Add guest</label>
        </div>
        <div class="input-field col s2 left">
          <a v-on:click="saveGuest()" class="btn-floating btn-large waves-effect waves-light red left"
            ><i class="material-icons">add</i></a
          >
        </div>
      </div>
    </form>
    <ul class="collection with-header">
      <li class="collection-header">
        <h4>Registered guests</h4>
      </li>
      <li v-for="guest in guestArray" :key="guest.id" class="collection-item avatar">
        <img src="images/user.png" alt="" class="circle" />
        <span class="title"></span>
        <a href="#!" class="secondary-content"
          ><i class="material-icons">grade</i>
        </a>
        {{guest.name}}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Guest",
  /**
   *   Este método carga los servicios REST. se utiliza la biblioteca 'axios'.
   *   Investigar acerca de axios para ver su implementación
   */
  created() {
    axios
      .get("/getGuest")
      .then((response) => (this.guestArray = response.data));
  },

  data() {
    return {
      guestArray: [],
      guest: "",
    };
  },

  methods: {
      saveGuest: function() {
          axios
          .post("/saveGuest",{
              name: this.guest,
          })
          .then((response) => (location.reload()));
      }
  }
};
</script>
