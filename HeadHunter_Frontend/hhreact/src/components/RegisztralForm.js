import React, { useState } from 'react';
import '../styles/Regisztral.css';

const Regisztral = () => {
    const [formData, setFormData] = useState({
        nem: '',
        szul_ido: '',
        telefonszam: '',
        fax: '',
        allampolgarsag: 'magyar',
        jogositvany: false,
        szoc_keszseg: ''
    });

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value
        });
    };

    const handleCheckboxChange = (e) => {
        const { name, checked } = e.target;
        setFormData({
            ...formData,
            [name]: checked
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(formData);
    };

    return (
        <div className="container">
            <header className="header">
                <h1>Regisztrácó </h1>
            </header>
            <form onSubmit={handleSubmit} className="registration-form">
                <div className="form-group">
                    <label>Gender:</label>
                    <input
                        type="text"
                        name="nem"
                        value={formData.nem}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="form-group">
                    <label>Date of Birth:</label>
                    <input
                        type="date"
                        name="szul_ido"
                        value={formData.szul_ido}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="form-group">
                    <label>Phone Number:</label>
                    <input
                        type="text"
                        name="telefonszam"
                        value={formData.telefonszam}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="form-group">
                    <label>Fax:</label>
                    <input
                        type="text"
                        name="fax"
                        value={formData.fax}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="form-group">
                    <label>Citizenship:</label>
                    <input
                        type="text"
                        name="allampolgarsag"
                        value={formData.allampolgarsag}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="form-group">
                    <label>Driver's License:</label>
                    <input
                        type="checkbox"
                        name="jogositvany"
                        checked={formData.jogositvany}
                        onChange={handleCheckboxChange}
                    />
                </div>
                <div className="form-group">
                    <label>Language Proficiency:</label>
                    <textarea
                        name="szoc_keszseg"
                        value={formData.szoc_keszseg}
                        onChange={handleInputChange}
                    ></textarea>
                </div>
                <div className="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    );
};

export default Regisztral;
