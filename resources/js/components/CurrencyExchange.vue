<template>
    <v-app>
        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="8"
                        md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                color="primary"
                                class="justify-center"
                                dark
                                flat
                            >
                                <v-toolbar-title>Currency Exchange</v-toolbar-title>
                                <div class="flex-grow-5"></div>
                            </v-toolbar>
                            <v-card-text>
                                <v-menu
                                    v-model="datepicker.menu"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="datepicker.value"
                                            label="Pick a date"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker v-model="datepicker.value" @input="datepicker.menu = false"></v-date-picker>
                                </v-menu>

                                <div v-if="loading" class="text-center">
                                    <v-progress-circular
                                        indeterminate
                                        color="primary"
                                    ></v-progress-circular>
                                </div>
                                <v-simple-table v-else>
                                    <thead>
                                    <tr>
                                        <th class="text-left">Currency</th>
                                        <th class="text-left">Rate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, key) in rates" :key="item.key">
                                        <td>{{ key }}</td>
                                        <td>{{ item }}</td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        data() {
            return {
                datepicker: {
                    value: null,
                    menu: false
                },
                rates: {},
                loading: true
            }
        },

        watch: {
            'datepicker.value': function () {
                this.getRates()
            }
        },

        methods: {
            getRates() {
                this.loading = true

                let url = '/currencies/exchange'
                if (this.datepicker.value) {
                    url += '?date=' + this.datepicker.value
                }

                axios.get(url)
                    .then(({data}) => {
                        this.rates = data
                        this.loading = false
                    })
            }
        },

        mounted() {
            this.getRates()
        }
    }
</script>
