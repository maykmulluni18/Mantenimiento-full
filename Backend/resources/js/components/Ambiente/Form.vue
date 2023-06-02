<template>
    <div class="container">
      <div class="card shadow-sm">
        <div class="card-header">
          <h2 v-if="isNewAmbiente">Agregar Nuevo Ambiente</h2>
        <h2 v-else>Editar Ambiente</h2>
      </div>
      <div class="card-body">


          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="name" class="form-label">Nombre Ambiente:</label>
              <input class="form-control" type="text" id="nombre_ambiente" v-model="ambiente.nombre_ambiente" required />
            </div>
            <button type="submit" v-if="isNewAmbiente" class="btn btn-primary">Agregar</button>
            <button type="submit" v-else class="btn btn-primary">Actualizar</button>
          </form>

      </div>
      </div>

    </div>

    </template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      ambiente: {
        nombre_ambiente: ''
      }
    }
  },
  computed: {
    isNewAmbiente() {
      return !this.$route.path.includes('edit');
    }
  },
  async created() {
    if (!this.isNewAmbiente) {
      const response = await axios.get(`/api/ambientes/${this.$route.params.id}`);
      this.ambiente = response.data;
    }
  },
  methods: {
    async submitForm() {
      try {
        if (this.isNewAmbiente) {
          await axios.post('/api/ambientes', this.ambiente);//al crear un nuevo producto
        } else {
          await axios.put(`/api/ambientes/${this.$route.params.id}`, this.ambiente); //all editar un nuevo producto
        }
        this.$router.push('/ambientes');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>
