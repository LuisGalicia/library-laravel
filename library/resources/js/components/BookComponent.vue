<template>
  <ul class="collection with-header">
    <li class="collection-header">
      <h4>Registered books</h4>
      <small class="blue-text text-darken-2"
        >Click on card to edit a book</small
      >
    </li>
    <li class="collection-item">
      <div class="input-field col s12">
        <i class="material-icons prefix">search</i>
        <input
          id="icon_search"
          type="text"
          placeholder="Search book..."
          v-model="filtrar"
        />
      </div>
    </li>
    <li
      v-for="book in filtrarLibro"
      :key="book.id"
      class="collection-item modal-trigger"
      href="#modalEditBook"
      v-on:click="cargaDatosModal(book)"
    >
      <div class="card medium">
        <div class="card-image">
          <img src="/images/libro-ejemplo.jpg" alt="libro de ejemplo" />
          <span class="card-title">{{ book.name }}</span>
        </div>
        <div class="card-content">
          <a
            v-on:click="deleteBook(book.id)"
            class="btn-floating btn-large waves-effect waves-light red right"
            ><i class="material-icons">delete</i></a
          >
          <p>{{ book.author }}</p>
          <p>{{ book.published_date }}</p>
          <p>{{ devuelveNombreCategoria(book.category_id) }}</p>
          <p>Borrowed to {{ devuelveNombreGuest(book.guest_id) }}</p>
        </div>
        <div v-if="book.available == 1" class="center">
          <a
            class="btn waves-effect waves-teal light-blue darken-3 modal-trigger"
            href="#modalBorrow"
            v-on:click="guardaIdBook(book.id)"
            ><h6>Borrow</h6>
          </a>
        </div>
        <div v-else class="center">
          <a
            class="btn waves-effect waves-teal light-red darken-3"
            v-on:click="removerBook(book.id)"
            ><h6>Remove book to {{ devuelveNombreGuest(book.guest_id)}}</h6>
          </a>
        </div>
      </div>
    </li>
    <div id="modalBorrow" class="modal">
      <div class="modal-content">
        <form method="POST">
          <ul class="collection with-header">
            <li class="collection-header"><h4>Borrow to...</h4></li>
            <li class="collection-item">
              <div class="input-field col s12">
                <i class="material-icons prefix">search</i>
                <input
                  id="icon_search_guest"
                  type="text"
                  placeholder="Search guest..."
                  v-model="buscarGuest"
                />
              </div>
            </li>
            <li
              v-for="guest in filtrarGuest"
              :key="guest.id"
              class="collection-item"
            >
              <div>
                {{ guest.name
                }}<a
                  v-on:click="asignarGuestLibro(guest.id)"
                  class="secondary-content"
                  ><i class="material-icons">send</i></a
                >
              </div>
            </li>
          </ul>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat"
          >Close</a
        >
      </div>
    </div>
    <div id="modalEditBook" class="modal">
      <div class="modal-content">
        <form method="POST">
          <h4 class="header center">Edit a book</h4>
          <div class="row">
            <div class="input-field col s10">
              <i class="material-icons prefix">book</i>
              <input
                v-model="editName"
                id="icon_edit_name"
                type="text"
                class="validate"
              />
            </div>
          </div>
          <div class="row">
            <div class="input-field col s10">
              <i class="material-icons prefix">person_pin</i>
              <input
                v-model="editAuthor"
                id="icon_edit_author"
                type="text"
                class="validate"
              />
            </div>
          </div>
          <div class="row">
            <div class="input-field col s10">
              <i class="material-icons prefix">bookmark_border</i>
              <input
                v-model="editCategory"
                id="icon_edit_category"
                type="text"
                class="validate"
              />
            </div>
          </div>
          <div class="row">
            <div class="input-field col s10">
              <i class="material-icons prefix">date_range</i>
              <input
                v-model="editPublished"
                id="icon_published_edit"
                type="date"
              />
            </div>
          </div>
          <div class="row">
            <div class="input-field col s2 left">
              <a
                v-on:click="editBook()"
                class="btn-floating btn-large waves-effect waves-light red right"
                ><i class="material-icons">edit</i></a
              >
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat"
          >Close</a
        >
      </div>
    </div>
  </ul>
</template>

<script>
import axios from "axios";

export default {
  created() {
    axios.get("/getBook").then((response) => (this.booksArray = response.data));

    axios
      .get("/getCategory")
      .then((response) => (this.categoriesArray = response.data));

    axios
      .get("/getGuest")
      .then((response) => (this.guestArray = response.data));
  },

  data() {
    return {
      booksArray: [],
      categoriesArray: [],
      booksFilterArray: [],
      guestFilterArray: [],
      guestArray: [],
      categoria: "",
      filtrar: "",
      buscarGuest: "",
      editAuthor: "",
      editCategory: "",
      editName: "",
      editPublished: "",
      editId: "",
    };
  },

  methods: {
    devuelveNombreCategoria: function (idBook) {
      for (let index = 0; index < this.categoriesArray.length; index++) {
        if (this.categoriesArray[index].id == idBook) {
          return this.categoriesArray[index].name;
        }
      }
      return "No tiene asignada";
    },

    devuelveIdCategoria: function (nombreCategoria) {
      for (let index = 0; index < this.categoriesArray.length; index++) {
        if (this.categoriesArray[index].name == nombreCategoria) {
          return this.categoriesArray[index].id;
        }
      }
      return 1;
    },

    devuelveNombreGuest: function (idGuest) {
      for (let index = 0; index < this.guestArray.length; index++) {
        if (this.guestArray[index].id == idGuest) {
          return this.guestArray[index].name;
        }
      }
      return "is available";
    },

    deleteBook: function (idBook) {
      axios.delete("/deleteBook/" + idBook).then(location.reload());
    },

    editBook: function () {
      axios
        .put("/editBook/" + this.editId, {
          name: this.editName,
          author: this.editAuthor,
          published_date: this.editPublished,
          category_id: this.devuelveIdCategoria(this.editCategory),
        })
        .then(location.reload());
    },

    asignarGuestLibro: function (idGuest) {
      axios
        .put("/editUserBook/" + this.editId, {
          guest_id: idGuest,
        })
        .then(location.reload());
    },

    removerBook: function(idBook) {
        axios
        .put("/changeAvailable/" + idBook)
        .then(location.reload());
    },

    guardaIdBook: function (idBook) {
      this.editId = idBook;
    },

    cargaDatosModal: function (book) {
      this.editAuthor = book.author;
      this.editCategory = this.devuelveNombreCategoria(book.category_id);
      this.editName = book.name;
      this.editPublished = book.published_date;
      this.editId = book.id;
    },
  },

  computed: {
    filtrarLibro: function () {
      return this.booksArray.filter((booksFilterArray) =>
        booksFilterArray.name.includes(this.filtrar)
      );
    },

    filtrarGuest: function () {
      return this.guestArray.filter((guestFilterArray) =>
        guestFilterArray.name.includes(this.buscarGuest)
      );
    },
  },
};
</script>
