import Vue from 'vue'
import { AclInstaller, AclCreate, AclRule } from 'vue-acl'
import router from '@/router'

Vue.use(AclInstaller)

let initialRole = 'user'

const userInfo = JSON.parse(localStorage.getItem('userInfo'))
if (userInfo && userInfo.userRole) initialRole = userInfo.userRole

export default new AclCreate({
  initial  : initialRole,
  notfound : '/pages/not-authorized',
  router,
  acceptLocalRules : true,
  globalRules: {
    superAdmin  : new AclRule('super-admin').generate(),
    admin  : new AclRule('admin').or('super-admin').generate(),
    user  : new AclRule('admin').or('super-admin').or('user').generate(),
    editor : new AclRule('editor').generate()
  }
})
