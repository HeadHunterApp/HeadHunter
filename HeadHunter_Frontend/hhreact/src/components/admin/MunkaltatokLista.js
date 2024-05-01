import React, { useState, useEffect } from 'react';
import axios from 'axios';
import "../../styles/Tables.css";

const MunkaltatokLista = () => {
  const [employers, setEmployers] = useState([]);
  const [newEmployer, setNewEmployer] = useState({
    cegnev: '',
    szekhely: '',
    kapcsolattarto: '',
    telefonszam: '',
    email: ''
  });

  useEffect(() => {
    const fetchEmployers = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/munkaltatok/all');
        setEmployers(response.data);
      } catch (error) {
        console.error('Error fetching employers:', error);
      }
    };

    fetchEmployers();
  }, []);

  const handleDelete = async (munkaltatoId) => {
    try {
      await axios.delete(`http://127.0.0.1:8000/api/munkaltatok/${munkaltatoId}`);
      setEmployers(employers.filter((employer) => employer.munkaltato_id !== munkaltatoId));
    } catch (error) {
      console.error('Error deleting employer:', error);
    }
  };

  const handleInputChange = (event) => {
    const { name, value } = event.target;
    setNewEmployer({ ...newEmployer, [name]: value });
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    try {
      await axios.post('http://127.0.0.1:8000/api/munkaltatok/new', newEmployer);
      setEmployers([...employers, newEmployer]);
      setNewEmployer({
        cegnev: '',
        szekhely: '',
        kapcsolattarto: '',
        telefonszam: '',
        email: ''
      });
    } catch (error) {
      console.error('Error adding new employer:', error);
    }
  };

  return (
    <div className="munkaltatok-container">
      <h2>Munkáltatók listája</h2>
      <table className="munkaltatok-table">
        <thead>
          <tr>
            <th>Cégnév</th>
            <th>Székhely</th>
            <th>Kapcsolattartó</th>
            <th>Telefonszám</th>
            <th>Email</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          {employers.map((employer) => (
            <tr key={employer.munkaltato_id}>
              <td>{employer.cegnev}</td>
              <td>{employer.szekhely}</td>
              <td>{employer.kapcsolattarto}</td>
              <td>{employer.telefonszam}</td>
              <td>{employer.email}</td>
              <td>
                <button onClick={() => handleDelete(employer.munkaltato_id)}>Törlés</button>
                <button>Módosítás</button>
                <button>Új felvitele</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <form onSubmit={handleSubmit}>
        <h2>Új munkáltató felvitele</h2>
        <label htmlFor="cegnev">Cégnév:</label>
        <input type="text" id="cegnev" name="cegnev" value={newEmployer.cegnev} onChange={handleInputChange} required />
        <label htmlFor="szekhely">Székhely:</label>
        <input type="text" id="szekhely" name="szekhely" value={newEmployer.szekhely} onChange={handleInputChange} required />
        <label htmlFor="kapcsolattarto">Kapcsolattartó:</label>
        <input type="text" id="kapcsolattarto" name="kapcsolattarto" value={newEmployer.kapcsolattarto} onChange={handleInputChange} required />
        <label htmlFor="telefonszam">Telefonszám:</label>
        <input type="tel" id="telefonszam" name="telefonszam" value={newEmployer.telefonszam} onChange={handleInputChange} required />
        <label htmlFor="email">Email:</label>
        <input type="email" id="email" name="email" value={newEmployer.email} onChange={handleInputChange} required />
        <button type="submit">Hozzáadás</button>
      </form>
    </div>
  );
};

export default MunkaltatokLista;
