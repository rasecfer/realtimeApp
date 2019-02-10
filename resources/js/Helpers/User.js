
import Token from './Token'
import AppStorage from './AppStorage'

class User {
  login(v_form){
    axios.post('/api/auth/login', v_form)
      .then(res => {
        this.responseAfterLogin(res)
      })
      .catch(error => console.log(error.response.data));
  }

  responseAfterLogin(res){
    const access_token = res.data.access_token
    const user_name = res.data.user
    if(Token.isValid(access_token)){
      AppStorage.store(user_name, access_token)
    }
  }

  hasToken(){
    const stored_token = AppStorage.getToken()
    if(stored_token){
      return Token.isValid(stored_token) ? true : false
    }
    return false
  }

  loggedIn(){
    return this.hasToken()
  }

  logout(){
    AppStorage.clear()
  }

  name(){
    if(this.loggedIn()){
      return AppStorage.getUser()
    }
  }

  id(){
    const payload = Token.payload(AppStorage.getToken())
    return payload.sub
  }
}

export default User = new User();