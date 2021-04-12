<template>
  <CModal title="Warning" size="lg"
    :show.sync="isShow"
    @update:show="hide"
    :centered="true">
    <CRow>
      <CCol col="12">
          <h4>Save</h4>
          <p>Are you sure?</p>
      </CCol>
    </CRow>
    <template #footer>
      <CButton color="danger" @click="doSave">Save</CButton>
      <CButton color="secondary" @click="hide()">Cancel</CButton>
    </template>
  </CModal>
</template>

<script>
  export default {
    name: 'ConfirmSave',
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
      doSave(){
        this.$emit('doSave', this.key);
        this.hide();
      }
    },
    mounted: function(){

    }
  }
</script>
