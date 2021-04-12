<template>
  <CRow>
    <CCol col="12">
      <transition name="slide">
      <CCard>
        <CCardHeader>
            Users
        </CCardHeader>
        <CCardBody>
          <CButton color="primary mb-2" @click="createUser()">Create</CButton>
          <CAlert :show.sync="dismissCountDown" color="primary" fade>
            ({{dismissCountDown}}) {{ message }}
          </CAlert>
          <CDataTable
            hover striped column-filter table-filter pagination sorter items-per-page-select
            :items="items"
            :fields="fields"
            :items-per-page="5"
            >
          <template #status="{item}">
            <td>
              <CBadge :color="getBadge(item.status)">{{ item.status }}</CBadge>
            </td>
          </template>
          <template #show="{item}">
            <td>
              <CButton color="primary" @click="showUser( item.id )">Show</CButton>
            </td>
          </template>
          <template #edit="{item}">
            <td>
              <CButton color="primary" @click="editUser( item.id )">Edit</CButton>
            </td>
          </template>
          <template #delete="{item}">
            <td>
              <CButton v-if="you!=item.id" color="danger" @click="deleteUser( item.id )">Delete</CButton>
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
  name: 'Users',
  data: () => {
    return {
      items: [],
      fields: ['id', 'full_name', 'short_name', 'registered', 'roles', 'status', 'show', 'edit', 'delete'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      you: null,
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
    getBadge (status) {
      return status === 'Active' ? 'success'
        : status === 'Inactive' ? 'secondary'
          : status === 'Pending' ? 'warning'
            : status === 'Banned' ? 'danger' : 'primary'
    },
    showUser (id ) {
      this.$router.push({path: `users/${id.toString()}`});
    },
    editUser (id ) {
      this.$router.push({path: `users/${id.toString()}/edit`});
    },
    createUser(){
      this.$router.push({path: 'users/create'});
    },
    deleteUser (id ) {
      this.$refs.ConfirmDeleteComponent.show(id);
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getUsers (){
      let self = this;
      axios.get(this.$apiAdress + '/api/users?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.users;
        self.you = response.data.you;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    doDelete(key){
      let self = this;
      axios.get(this.$apiAdress + '/api/users/delete?token=' + localStorage.getItem("api_token") + '&id=' + key, {})
      .then(function (response) {
          self.message = 'Successfully deleted user.';
          self.showAlert();
          self.getUsers();
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    }
  },
  mounted: function(){
    this.getUsers();
  }
}
</script>
