import React from 'react';
import '../styles/ModalLoginForm.css'; // Import CSS file for styling

class LoginModalForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isOpen: false
    };
  }

  // Function to toggle the modal state
  toggleModal = () => {
    this.setState(prevState => ({
      isOpen: !prevState.isOpen
    }));
  };

  render() {
    return (
      <div>
        {/* Button to open the popup form */}
        <button className="open-button" onClick={this.toggleModal}>Open Form</button>

        {/* The form */}
        <div className={this.state.isOpen ? 'modal open' : 'modal'}>
          <div className="modal-content">
            <span className="close" onClick={this.toggleModal}>&times;</span>
            <form action="/action_page.php" className="form-container">
              <h1>Login</h1>

              <label htmlFor="email"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" required />

              <label htmlFor="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required />

              <button type="submit" className="btn">Login</button>
            </form>
          </div>
        </div>
      </div>
    );
  }
}

export default LoginModalForm;
