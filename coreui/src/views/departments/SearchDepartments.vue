<template>
  <CModal title="Departments Search" size="lg" :show.sync="isShow" @update:show="hide" >
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
                <CButton color="primary" @click="selected( item.id )">Select</CButton>
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
  name: 'Departments',  
  data: () => {
    return {
      items: [],
      fields: ['show', 'id', 'name', 'total_floor', 'total_block'],
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
    selected(id){
      this.$emit('return', id);
      this.hide();
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
    }
  },
  mounted: function(){    
    // this.isShow = this.largeModal;
    this.getDepartments();
  }
}
</script>
