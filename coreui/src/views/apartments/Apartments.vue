<template>
  <CRow>
    <CCol col="12">
      <transition name="slide">
      <CCard>
        <CCardHeader>
            Apartments
        </CCardHeader>
        <CCardBody>
          <CButton color="primary mb-2" @click="createApartment()">Create</CButton>
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
            :items-per-page="20"
          >
          <template #show="{item}">
            <td>
              <CButton color="primary" @click="showApartment( item.id )">Show</CButton>
            </td>
          </template>
          <template #edit="{item}">
            <td>
              <CButton color="primary" @click="editApartment( item.id )">Edit</CButton>
            </td>
          </template>
          <template #delete="{item}">
            <td>
              <CButton color="danger" @click="deleteApartment( item.id )">Delete</CButton>
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
  name: 'Apartments',
  data: () => {
    return {
      items: [],
      fields: ['block_name', 'code', 'floor', 'status', 'show', 'edit', 'delete'],
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
  components: {
    ConfirmDelete
  },
  paginationProps: {
    align: 'center',
    doubleArrows: false,
    previousButtonHtml: 'prev',
    nextButtonHtml: 'next'
  },
  methods: {
    showApartment ( id ) {
      this.$router.push({path: `apartments/${id.toString()}`});
    },
    editApartment ( id ) {
      this.$router.push({path: `apartments/${id.toString()}/edit`});
    },
    createApartment(){
      this.$router.push({path: 'apartments/create'});
    },
    deleteApartment ( id ) {
      this.$refs.ConfirmDeleteComponent.show(id);
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getApartments (){
      let self = this;
      axios.get(  this.$apiAdress + '/api/apartments?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.apartments;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    doDelete(key){
      let self = this;
      console.log(key);
      axios.get(  this.$apiAdress + '/api/apartments/delete?token=' + localStorage.getItem("api_token") + '&id=' + key)
      .then(function (response) {
          self.message = 'Successfully deleted apartment.';
          self.showAlert();
          self.getApartments();
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    }
  },
  mounted: function(){
    this.getApartments();
  }
}
</script>
