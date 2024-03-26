import React from 'react';
import '../styles/ModalLoginForm.css'; 
import Regisztral from './RegisztralForm';
import Bejelentkezes from './Bejelentkezes';



class LoginModalForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isRegistryOpen: false,
      isLoginOpen: false
    };
  }

  // modal state toggle funkció
  toggleRegistryModal = () => {
    this.setState(prevState => ({
      isRegistryOpen: !prevState.isRegistryOpen
    }));
  };

  toggleLoginModal = () => {
    this.setState(prevState => ({
      isLoginOpen: !prevState.isLoginOpen
    }));
  };

  render() {
    return (
      <div>
      <div className="button-container">
        {/* gomb ami megnyitja a modalt */}
        <button className="open-button" onClick={this.toggleLoginModal}>Bejelentkezés</button>
        <button className="open-button" onClick={this.toggleRegistryModal}>
            Regisztráció
          </button>
        {/* form */}
        <div className={this.state.isLoginOpen ? 'modal open' : 'modal'}>
          <div className="modal-content">
            <span className="close" onClick={this.toggleLoginModal}>&times;</span>
          
           <Bejelentkezes/>
          </div>
        </div>
      </div>
        {/* gomb ami megnyitja a popupot*/}
        

        {/* The form */}
        <div className={this.state.isRegistryOpen ? 'modal open' : 'modal'}>
          <div className="modal-content">
            <span className="close" onClick={this.toggleRegistryModal}>&times;</span>
            {/* <form action="/action_page.php" className="form-container"> */}
{/*               <h1>Login</h1>

              <label htmlFor="email"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" required />

              <label htmlFor="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required />

              <button type="submit" className="btn">Login</button> */}
            <Regisztral/>
           {/*  </form> */}
          </div>
        </div>
      </div>
    );
  }
}

export default LoginModalForm;
