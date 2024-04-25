import axios from "../api/axios";

export const getTerulet = ()=>
    axios.get(`/api/hunter/fields/all`);
