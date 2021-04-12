<template>
  <CRow>
    <CCol col="12">

      <transition name="slide">
      <CCard>
        <CCardHeader>
            Blocks
        </CCardHeader>
        <CCardBody>
          <CButton color="primary mb-2" @click="createBlock()">Create</CButton>
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
              <CButton color="primary" @click="showBlock( item.id )">Show</CButton>
            </td>
          </template>
          <template #edit="{item}">
            <td>
              <CButton color="primary" @click="editBlock( item.id )">Edit</CButton>
            </td>
          </template>
          <template #delete="{item}">
            <td>
              <CButton color="danger" @click="deleteBlock( item.id )">Delete</CButton>
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
  name: 'Blocks',
  data: () => {
    return {
      items               : [],
      fields              : ['id', 'department_name', 'name', 'show', 'edit', 'delete'],
      currentPage         : 1,
      perPage             : 5,
      totalRows           : 0,
      message             : '',
      showMessage         : false,
      dismissSecs         : 7,
      dismissCountDown    : 0,
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
    showBlock (id ) {
      this.$router.push({path: `blocks/${id.toString()}`});
    },
    editBlock (id ) {
      this.$router.push({path: `blocks/${id.toString()}/edit`});
    },
    createBlock(){
      this.$router.push({path: 'blocks/create'});
    },
    deleteBlock (id ) {
      this.$refs.ConfirmDeleteComponent.show(id);
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getBlocks (){
      let self = this;
      axios.get(this.$apiAdress + '/api/blocks?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.blocks;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    doDelete(key){
      let self = this;
      console.log(key);
      axios.get(this.$apiAdress + '/api/blocks/delete?token=' + localStorage.getItem("api_token") + '&id=' + key, {})
      .then(function (response) {
          self.message = 'Successfully deleted Block.';
          self.showAlert();
          self.getBlocks();
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    }
  },
  mounted: function(){
    this.getBlocks();
  }
}
</script>