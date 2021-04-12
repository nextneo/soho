<template>
  <CRow>
    <CCol col="12">

      <transition name="slide">
      <CCard>
        <CCardHeader>
            Category
        </CCardHeader>
        <CCardBody>
          <CButton color="primary mb-2" @click="createCategory()">Create</CButton>
          <CAlert
            :show.sync="dismissCountDown"
            color="primary"
            fade
          >
            ({{dismissCountDown}}) {{ message }}
          </CAlert>
          <CDataTable
            hover striped column-filter table-filter pagination sorter items-per-page-select
            :items="items"
            :fields="fields"
            :items-per-page="5"
          >
          <template #info="{item}">
            <td v-html="item.info">
            </td>
          </template>
          <template #show="{item}">
            <td>
              <CButton color="primary" @click="showCategory( item.id )">Show</CButton>
            </td>
          </template>
          <template #edit="{item}">
            <td>
              <CButton color="primary" @click="editCategory( item.id )">Edit</CButton>
            </td>
          </template>
          <template #delete="{item}">
            <td>
              <CButton color="danger" @click="deleteCategory( item.id )">Delete</CButton>
            </td>
          </template>
        </CDataTable>
        </CCardBody>
      </CCard>
      </transition>
    </CCol>
    <CCol col="12">
      <ConfirmDelete ref="ConfirmDeleteComponent" @doDelete="doDelete"></ConfirmDelete>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
import ConfirmDelete from '../modal/ConfirmDelete.vue'
export default {
  name: 'Category',
  data: () => {
    return {
      items: [],
      fields: ['id', 'name', 'info', 'show', 'edit', 'delete'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false
    }
  },
  paginationProps: {
    align: 'center',
    doubleArrows: false,
    previousButtonHtml: 'prev',
    nextButtonHtml: 'next'
  },
  components: {
    ConfirmDelete
  },
  methods: {
    showCategory (id ) {
      this.$router.push({path: `category/${id.toString()}`});
    },
    editCategory (id ) {
      this.$router.push({path: `category/${id.toString()}/edit`});
    },
    createCategory(){
      this.$router.push({path: 'category/create'});
    },
    deleteCategory (id ) {
      this.$refs.ConfirmDeleteComponent.show(id);
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getCategory (){
      let self = this;
      axios.get(this.$apiAdress + '/api/category?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.category;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    doDelete(key){
      let self = this;
      axios.get(this.$apiAdress + '/api/category/delete?token=' + localStorage.getItem("api_token") + '&id=' + key, {})
      .then(function (response) {
          self.message = 'Successfully deleted Category.';
          self.showAlert();
          self.getCategory();
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
  },
  mounted: function(){
    this.getCategory();
  }
}
</script>