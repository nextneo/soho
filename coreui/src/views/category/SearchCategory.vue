<template>
  <CModal title="Category Search" size="lg" :show.sync="isShow" @update:show="hide" >
    <CRow>
      <CCol col="12">
        <transition name="slide">
          <CDataTable
            hover
            striped
            :items="items"
            :fields="fields"
            :items-per-page="5"
            pagination
          >
            <template #show="{item}">
              <td>
                <CButton color="primary" @click="selected( item )">Select</CButton>
              </td>
            </template>
          </CDataTable>
        </transition>
      </CCol>
    </CRow>
    <template #footer>
      <CButton color="secondary" @click="hide()">Cancel</CButton>
    </template>
  </CModal>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Category',
  data: () => {
    return {
      items: [],
      fields: ['show', 'id', 'name'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      isShow: false,
    }
  },
  paginationProps: {
    align: 'center',
    doubleArrows: false,
    previousButtonHtml: 'prev',
    nextButtonHtml: 'next'
  },
  methods: {
    show(){
      this.isShow = true;
    },
    hide(){
      this.isShow = false;
    },
    selected(item){
      this.$emit('return', item);
      this.hide();
    },
    getCategory (){
      let self = this;
      axios.get(  this.$apiAdress + '/api/category?token=' + localStorage.getItem("api_token"))
      .then(function (response) {
        self.items = response.data.category;
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    }
  },
  mounted: function(){
    // this.isShow = this.largeModal;
    this.getCategory();
  }
}
</script>
