<template>
  <CRow>
    <CCol col="12">
      <CCard>
        <CCardHeader>
          User id:  {{ $route.params.id }}
        </CCardHeader>
        <CCardBody>
          <CDataTable striped small fixed :items="items" :fields="fields">         
            <template slot="value" slot-scope="data">
              <td>{{data.item.value}}</td>
            </template>
          </CDataTable>
          <div class="row" v-show="image">
            <br>
            <div class="col-sm-4">
              Image
            </div>
            <div class="col-sm-8">
              <img v-bind:src="image"/>
          </div>
        </div>
        </CCardBody>
        <CCardFooter>
          <CButton color="secondary" @click="goBack">Back</CButton>
        </CCardFooter>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'User',
  data: () => {
    return {
      items: [],
      image: '',
      fields: [
        {key: 'key'},
        {key: 'value'},
      ],
    }
  },
  methods: {
    getUserData (id) {
      const user = usersData.find((user, index) => index + 1 == id)
      const userDetails = user ? Object.entries(user) : [['id', 'Not found']]
      return userDetails.map(([key, value]) => { return { key, value } })
    },
    goBack() {
      this.$router.go(-1)
    }
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/users/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
      const item = Object.entries(response.data);
      self.image = response.data.images;
      let items = item.filter(function(i) {
        if(i[0] != 'images'){
          return true;
        }
        return false;
      });
      self.items = items.map(([key, value]) => {return {key: key, value: value}});
    }).catch(function (error) {
      console.log(error);
      // self.$router.push({ path: '/login' });
    });
  }
}
</script>
