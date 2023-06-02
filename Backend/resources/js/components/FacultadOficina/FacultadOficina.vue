<template>
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-md-center">
                <div class="col-6">
                    <h3>Facultad u Oficinas</h3>
                </div>
                <div class="col-6">
                    <router-link
                        :to="{ name: 'facultadOficina/create' }"
                        type="button"
                        class="btn btn-outline-secondary"
                        >Crear en Facultad u Oficinas
                    </router-link>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#item</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre Facultad u Oficina</th>
                            <th scope="col">Nombre Escuela</th>
                            <th scope="col">Nombre Ambiente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="facultadOficina in facultadOficinas" :key="facultadOficina.id">
                            <td>{{ facultadOficina.id }}</td>
                            <td>{{ facultadOficina.cod_facultadOfi }}</td>
                            <td>{{ facultadOficina.nombre_facultad_oficina }}</td>
                            <td>{{ facultadOficina.nombre_escuela }}</td>
                            <td>{{ facultadOficina.ambientes.nombre_ambiente }}</td>

                            <td>
                                <div class="row gap-3">

                                    <router-link
                                        :to="`/facultadOficina/${facultadOficina.id}/edit`"
                                        class="p-2 col border btn btn-success"
                                        >Edit</router-link
                                    >
                                    <button
                                        @click="deleteFacultadOficina(facultadOficina.id)"
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
            facultadOficinas: [],
        };
    },
    async created() {
        try {
            const response = await axios.get("/api/facultadOficina");
            this.facultadOficinas = response.data;
        } catch (error) {
            console.error(error);
        }
    },
    methods: {
        async deleteFacultadOficina(id) {
            try {
                await axios.delete(`/api/facultadOficina/${id}`);
                this.facultadOficinas = this.facultadOficinas.filter(
                    (facultadOficinas) => facultadOficinas.id !== id
                );
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
