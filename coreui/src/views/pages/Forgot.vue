<template>
  <div class="d-flex align-items-center min-vh-100">
    <CContainer fluid>
      <CRow class="justify-content-center">
        <CCol md="6">
          <CCard class="mx-4 mb-0">
            <CCardBody class="p-4">
              <CForm @submit.prevent="register" method="POST">
                <h1>Forgot your password?</h1>
                <p class="text-muted">Enter your email address to reset your password. </br>You may need to check your spam folder or unblock no-reply@dropbox.com.</p>
                <CInput
                  placeholder="Email"
                  prepend="@"
                  autocomplete="email"
                  v-model="email"
                />
                  <template #prepend-content><CIcon name="cil-lock-locked"/></template>
                </CInput>
                <CButton type="submit" color="success" block>Submit</CButton>
              </CForm>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

  <script>
    import axios from 'axios'
    export default {
      data() {
        return {
          email: '',
        }
      },
      methods: {
        register() {
          var self = this;
          axios.post(  this.$apiAdress + '/api/forgot', {
            email: self.email,
          }).then(function (response) {
            self.name = '';
            self.email = '';
            self.password = '';
            self.password_confirmation = '';
            console.log(response);
            self.$router.push({ path: '/login' });
          })
          .catch(function (error) {
            console.log(error);
          });

        }
      }
    }

  </script>
