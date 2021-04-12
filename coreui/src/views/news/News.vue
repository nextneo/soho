<template>
  <CRow>
    <CCol col="12">

      <transition name="slide">
      <CCard>
        <CCardHeader>
            News
        </CCardHeader>
        <CCardBody>
          <CButton color="primary mb-2" @click="createNew()">Create</CButton>
          <CAlert :show.sync="dismissCountDown" color="primary" fade>
            ({{dismissCountDown}}) {{ message }}
          </CAlert>
          <CDataTable
            hover striped column-filter table-filter pagination sorter items-per-page-select
            :items="items"
            :fields="fields"
            :items-per-page="5"
            pagination>
          <template #body="{item}">
            <td v-html="item.body">
            </td>
          </template>
          <template #show="{item}">
            <td>
              <CButton color="primary" @click="showNew( item.id )">Show</CButton>
            </td>
          </template>
          <template #edit="{item}">
            <td>
              <CButton color="primary" @click="editNew( item.id )">Edit</CButton>
            </td>
          </template>
          <template #delete="{item}">
            <td>
              <CButton color="danger" @click="deleteNew( item.id )">Delete</CButton>
            </td>
          </template>
        </CDataTable>
        </CCardBody>
      </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'

export default {
  name: 'New',
  data: () => {
    return {
      items: [],
      fields: ['id', 'category_name', 'title', 'show', 'edit', 'delete'],
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
  methods: {
    showNew ( id ) {
      this.$router.push({path: `news/${id.toString()}`});
    },
    editNew ( id ) {
      this.$router.push({path: `news/${id.toString()}/edit`});
    },
    createNew(){
      this.$router.push({path: 'news/create'});
    },
    deleteNew ( id ) {
      let self = this;
      axios.get(  this.$apiAdress + '/api/news/delete?token=' + localStorage.getItem("api_token") + '&id=' + id, {})
      .then(function (response) {
          self.message = 'Successfully deleted New.';
          self.showAlert();
          self.getNew();
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
    getNew (){
      let self = this;
      axios.get(  this.$apiAdress + '/api/news?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.news;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    }
  },
  mounted: function(){
    this.getNew();
  }
}
</script>