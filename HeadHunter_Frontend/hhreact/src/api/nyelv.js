import axios from "../api/axios";

export const getAllaskeresoNyelvek = ()=>
    axios.get('/api/seeker/languages/all');
