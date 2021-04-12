<template>
  <CModal title="Delete" size="lg"
    :show.sync="isShow"
    @update:show="hide"
    :centered="true">
    <CRow>
      <CCol col="12">
          <p>Are you sure?</p>
      </CCol>
    </CRow>
    <template #footer>
      <CButton color="danger" @click="doDelete">Delete</CButton>
      <CButton color="secondary" @click="hide()">Cancel</CButton>
    </template>
  </CModal>
</template>

<script>
  export default {
    name: 'ConfirmDelete',
    data: () => {
      return {
        isShow: false,
        key : '',
      }
    },
    methods: {
      show(id){
        this.isShow = true;
        this.key = id;
      },
      hide(){
        this.isShow = false;
      },
      doDelete(){
        this.$emit('doDelete', this.key);
        this.hide();
      }
    },
    mounted: function(){

    }
  }
</script>
