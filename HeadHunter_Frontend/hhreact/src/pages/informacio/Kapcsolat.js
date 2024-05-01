import React, { useState } from "react";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";

import "../../styles/Kapcsolat.css";

export default function Kapcsolat() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });

  const [messageSent, setMessageSent] = useState(false); // State to track if message is sent
  const [errorMessage, setErrorMessage] = useState(""); // State to track error message

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevState) => ({
      ...prevState,
      [name]: value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Check if any field is empty
    if (!formData.name || !formData.email || !formData.message) {
      setErrorMessage("Kérlek töltsd ki az összes mezőt!");
    } else {
      // Implement message sending logic here
      console.log(formData);
      // Set message sent to true after form submission
      setMessageSent(true);
      // Clear form fields after submission
      setFormData({
        name: "",
        email: "",
        message: "",
      });
      // Automatically hide message after 3 seconds
      setTimeout(() => {
        setMessageSent(false);
      }, 3000);
      // Clear error message
      setErrorMessage("");
    }
  };

  return (
    <div className="kapcsolat-container">
      {messageSent && <div className="popup">Üzenet elküldve!</div>}{" "}
      {/* Popup message */}
      {errorMessage && <div className="error-message">{errorMessage}</div>}{" "}
      {/* Error message */}
      <div className="contact-info">
        <p>Cégnév: HeadHunter</p>
        <p>Cím: Budapest 1148, Fogarasi utca 12.</p>
        <p>Email: info@headhunter.com</p>
        <p>Telefonszám: +36 1 221 3178</p>
      </div>
      <h2>Kapcsolat</h2>
      <p>
        Ha bármilyen kérdésed van, kérlek töltsd ki az alábbi űrlapot, és
        válaszolni fogunk neked!
      </p>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="name">Név</label>
          <input
            type="text"
            id="name"
            name="name"
            value={formData.name}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label htmlFor="email">Email cím</label>
          <input
            type="email"
            id="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label htmlFor="message">Üzenet</label>
          <textarea
            id="message"
            name="message"
            value={formData.message}
            onChange={handleChange}
            required
          ></textarea>
        </div>
        <button type="submit">Üzenet küldése</button>
      </form>
      <div className="download-button small-button">
        <a
          href="/GDPR_jogszabály_magyarul.pdf"
          download="GDPR_jogszabály_magyarul.pdf"
          style={{ fontSize: "14px", width: "100px", height: "30px" }}
        >
          GDPR szabályzat letöltése
        </a>
      </div>
      <div className="map-container">
        <div className="map-wrapper">
          <MapContainer center={[47.4979, 19.0402]} zoom={13}>
            <TileLayer
              url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
              attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            />
            <Marker position={[47.4979, 19.0402]}>
              <Popup>Hello. Itt vagyunk!</Popup>
            </Marker>
          </MapContainer>
        </div>
      </div>
    </div>
  );
}
