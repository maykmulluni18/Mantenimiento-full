<template>
    <div class="container">
      <div class="card shadow-sm">
        <div class="card-header">
          <h2 v-if="isNewFacultadOficina">Agregar Facultad u Oficina</h2>
        <h2 v-else>Editar Facultad u Oficina</h2>
      </div>
      <div class="card-body">


          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="name" class="form-label">Codigo:</label>
              <input class="form-control" type="text" id="codigo" v-model="facultadOficinas.cod_facultadOfi" required />
            </div>
            <div class="form-group">
              <label for="name" class="form-label">Nombre Facultad u Oficina:</label>
              <input class="form-control" type="text" id="codigo" v-model="facultadOficinas.nombre_facultad_oficina" required />
            </div>
            <div class="form-group">
              <label for="name" class="form-label">Nombre Escuela:</label>
              <input class="form-control" type="text" id="codigo" v-model="facultadOficinas.nombre_escuela" required />
            </div>
            <!-- <div class="form-group">
              <label for="name" class="form-label">Ambiente:</label>
              <select class="form-control"
              v-model="facultadOficinas.ambientes_id"

              >
              <option value="0">
                Select
              </option>
              <option
                v-for="ambiente in ambientes"
                :key="ambiente.id"
                :value="ambiente.id"
              >
                {{ambiente.nombre_ambiente}}
              </option>
              </select>
            </div> -->
            <div class="form-group">
              <label for="name" class="form-label">Estado:</label>
              <AutoComplete
              v-model="facultadOficinas.ambientes_id" dropdown :suggestions="filteredItems_1" @complete="search1" />
}            </div>
            <button type="submit" v-if="isNewFacultadOficina" class="btn btn-primary">Agregar</button>
            <button type="submit" v-else class="btn btn-primary">Actualizar</button>
          </form>

      </div>
      </div>

    </div>

    </template>

<script setup>

import { ref } from "vue";
import AutoComplete from 'primevue/autocomplete';

const items_1 = ref([]);
const filteredItems_1 = ref([]);
/*const search1 = async (event) => {
  try {
    const responseAmbiente = await axios.get('/api/ambientes');
    items_1.value = responseAmbiente.data;
    filterItems(event.query);
    facultadOficinas.ambientes_id = selectedAmbiente ? selectedAmbiente.id : null;
  } catch (error) {
    console.error(error);
  }
};
*/
/*const search1 = async (event) => {
  try {
    const responseAmbiente = await axios.get('/api/ambientes');
    items_1.value = responseAmbiente.data.map((item) => item.nombre_ambiente);
    filterItems(event.query);
  } catch (error) {
    console.error(error);
  }
};*/
/*const search1 = async (event) => {
  try {
    const responseAmbiente = await axios.get('/api/ambientes');
    items_1.value = responseAmbiente.data.map((item) => item.nombre_ambiente);
    filterItems(event.query);

    // Obtener el ID seleccionado
    const selectedId = selectedAmbiente ? selectedAmbiente.id : null;

    if (selectedId !== null) {
      // Hacer la solicitud al backend para enviar el ID seleccionado
      await axios.post('/api/guardarAmbiente', { id: selectedId });
    }
  } catch (error) {
    console.error(error);
  }
};*/

const search1 = async (event) => {
  try {
    const responseAmbiente = await axios.get('/api/ambientes');
    items_1.value = responseAmbiente.data.map((item) => item.nombre_ambiente);
    filterItems(event.query);

    // Obtener el ID seleccionado
    const selectedId = selectedAmbiente.value ? selectedAmbiente.value.id : null;

    if (selectedId !== null) {
      // Hacer la solicitud al backend para enviar el ID seleccionado
      await axios.post('/api/facultadOficina', { id: selectedId });
    }
  } catch (error) {
    console.error(error);
  }
};

const filterItems = (query) => {
  filteredItems_1.value = items_1.value.filter((item) =>
    item.toLowerCase().includes(query.toLowerCase())
  );
};

</script>
<script>
import axios from 'axios';
export default {
  data() {
    return {
        facultadOficinas: {
        cod_facultadOfi:'',
        nombre_facultad_oficina:'',
        nombre_escuela:'',
        ambientes_id:''
      },
      /*ambientes: [],*/

    }
  },

  computed: {
    isNewFacultadOficina() {
      return !this.$route.path.includes('edit');
    }
  },
  async created() {
    try{
       /* const responseAmbiente = await axios.get("/api/ambientes");
        this.ambientes = responseAmbiente.data;*/

        if (!this.isNewFacultadOficina) {
        const response = await axios.get(`/api/facultadOficina/${this.$route.params.id}`);
        this.facultadOficinas = response.data;
        }
    }catch(e){
        console.log(e);
    }
   /* else{
     const responseAmbiente = await axios.get("/api/ambientes");
      this.ambientes = responseAmbiente.data;
      console.log(this.ambientes);
    }*/
  },

  methods: {
    async submitForm() {
      try {
        if (this.isNewFacultadOficina) {
          this.Oficina = await axios.post('/api/facultadOficina', this.facultadOficinas);//al crear un nuevo producto
        console.log(this.Oficina);
        } else {
          await axios.put(`/api/facultadOficina/${this.$route.params.id}`, this.facultadOficinas); //all editar un nuevo producto
        }
        this.$router.push('/facultadOficina');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>
