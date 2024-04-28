import axios from "../api/axios";

export const getTerulet = ()=>
    axios.get(`/api/hunter/fields/all`);

export const getAllaskeresoTeruletek = ()=>
    axios.get('/api/seeker/fields/all');
