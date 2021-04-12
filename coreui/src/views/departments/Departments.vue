<template>
  <CRow>
    <CCol col="12">
      <transition name="slide">
      <CCard>
        <CCardHeader>
            Departments
        </CCardHeader>
        <CCardBody>
          <CButton color="primary mb-2 mr-2" @click="createDepartment()">Create</CButton>
          <CAlert :show.sync="dismissCountDown" color="primary" fade>
            ({{dismissCountDown}}) {{ message }}
          </CAlert>
          <CDataTable
            hover striped column-filter table-filter pagination sorter items-per-page-select
            :items="items"
            :fields="fields"
            :items-per-page="5"
          >
          <template #show="{item}">
            <td>
              <CButton color="primary" @click="showDepartment( item.id )">Show</CButton>
            </td>
          </template>
          <template #edit="{item}">
            <td>
              <CButton color="primary" @click="editDepartment( item.id )">Edit</CButton>
            </td>
          </template>
          <template #delete="{item}">
            <td>
              <CButton color="danger" @click="deleteDepartment( item.id )">Delete</CButton>
            </td>
          </template>
        </CDataTable>
        </CCardBody>
      </CCard>
      </transition>
    </CCol>
    <CCol col="12">
      <SearchDepartments ref="childComponent" @return="callBack"></SearchDepartments>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
import SearchDepartments from './SearchDepartments.vue'
import { freeSet } from '@coreui/icons'

export default {
  name: 'Departments',
  freeSet,
  data: () => {
    return {
      items: [],
      fields: ['id', 'name', 'total_floor', 'total_block', 'show', 'edit', 'delete'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      largeModal: false,
    }
  },
  components: {
    SearchDepartments
  },
  paginationProps: {
    align: 'center',
    doubleArrows: false,
    previousButtonHtml: 'prev',
    nextButtonHtml: 'next'
  },
  methods: {
    showDepartment ( id ) {
      this.$router.push({path: `departments/${id.toString()}`});
    },
    editDepartment ( id ) {
      this.$router.push({path: `departments/${id.toString()}/edit`});
    },
    createDepartment(){
      this.$router.push({path: 'departments/create'});
    },
    deleteDepartment ( id ) {
      let self = this;
      axios.get(  this.$apiAdress + '/api/departments/delete?token=' + localStorage.getItem("api_token") + '&id=' + id, {})
      .then(function (response) {
          self.message = 'Successfully deleted Department.';
          self.showAlert();
          self.getDepartments();
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getDepartments (){
      let self = this;
      axios.get(  this.$apiAdress + '/api/departments?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.departments;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    callBack(id){
      console.log(id);
    },
    toKebabCase (str) {
      return str.replace(/([a-z])([A-Z0-9])/g, '$1-$2').toLowerCase()
    }
  },
  mounted: function(){
    this.getDepartments();
  }
}
</script>
