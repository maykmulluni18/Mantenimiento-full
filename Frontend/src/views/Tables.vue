<template>
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-md-center">
                <div class="col-6">
                    <h3>Ambientes</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#item</th>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ambiente in ambientes" :key="ambiente.id">
                            <td>{{ ambiente.id }}</td>
                            <td>{{ ambiente.nombre_ambiente }}</td>
                            <td>
                                <div class="row gap-3">
                                    <button
                                        @click="deleteAmbiente(ambiente.id)"
                                        type="button"
                                        class="p-2 col border btn btn-danger"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      ambientes: [],
    };
  },
  async created() {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/ambientes");
      this.ambientes = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteAmbiente(id) {
      try {
        await axios.delete(`/api/ambientes/${id}`);
        this.ambientes = this.ambientes.filter(
          (ambientes) => ambientes.id !== id
        );
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
