import axios from "../api/axios";

//post és put az AllasContextben, azt a fejvadász is eléri

//allas
export const getAllasAdminAll = ()=>
    axios.get(`/api/jobs-all`);
    
export const getAllasAdmin = (allas_id)=>
    axios.get(`/api/jobs/${allas_id}`);

export const deleteAllas = (allas_id)=>
    axios.delete(`/api/jobs/delete/${allas_id}`);
    
//allas-ismeret
export const getAllasIsmeretAll = ()=>
    axios.get(`/api/jobs/skills`);
    
export const getAllasIsmAdmin = (allas_id)=>
    axios.get(`/api/jobs/${allas_id}/skills`);
 
export const deleteAllasIsmeret = (allas_id)=>
    axios.delete(`/api/jobs/${allas_id}/skills/delete`);
    
//allas-nyelvtudas
export const getAllasNyelvtudasAll = ()=>
    axios.get(`/api/jobs/languages`);
    
export const getAllasNyelvAdmin = (allas_id)=>
    axios.get(`/api/jobs/${allas_id}/languages`);

export const deleteAllasNyelvtudas = (allas_id)=>
    axios.delete(`/api/jobs/${allas_id}/languages/delete`);
    
//allas-vegzettseg
export const getAllasVegzettsegAll = ()=>
    axios.get(`/api/jobs/edu-atts`);
    
export const getAllasVegzAdmin = (allas_id)=>
    axios.get(`/api/jobs/${allas_id}/edu-atts`);

export const deleteAllasVegzettseg = (allas_id)=>
    axios.delete(`/api/jobs/${allas_id}/edu-atts/delete`);
    
//allas-tapasztalat
export const getAllasTapasztalatAll = ()=>
    axios.get(`/api/jobs/exps`);
    
export const getAllasTapAdmin = (allas_id)=>
    axios.get(`/api/jobs/${allas_id}/exps`);

export const deleteAllasTapasztalat = (allas_id)=>
    axios.delete(`/api/jobs/${allas_id}/exps/delete`);
    
//allas-jelentkezo

export const deleteAllasJelentkezo = (allas_id)=>
    axios.delete(`/jobs/${allas_id}/applicants/delete`);