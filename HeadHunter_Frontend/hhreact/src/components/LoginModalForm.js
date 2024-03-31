import React from 'react';
import '../styles/components/ModalLoginForm.css'; 
import Regisztracio from './Regisztracio';
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
        <button className="open-button" onClick={this.toggleRegistryModal}>Regisztráció</button>
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
            <Regisztracio/>
          </div>
        </div>
      </div>
    );
  }
}

export default LoginModalForm;
