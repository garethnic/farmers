<template>
    <main>
        <section>
            <div class="container">
                <div class="row mt-2 mx-auto justify-content-center align-content-center">
                    <div class="col text-center">
                        <h1 class="heading-text">Farm Attacks</h1>
                        <h4>in {{ year }}</h4>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container h-100 mx-auto d-flex">
                <div class="row mt-3 mx-auto">
                    <div class="col text-center">
                        <div class="container d-flex flex-column">
                            <div class="row mx-auto">
                                <div class="col numbers">{{ murders }}</div>
                            </div>
                            <div class="row">
                                <div class="col descriptor">Murders</div>
                            </div>
                        </div>
                        <div class="container mt-2 d-flex flex-column">
                            <div class="row mx-auto">
                                <div class="col numbers">{{ assaults }}</div>
                            </div>
                            <div class="row">
                                <div class="col descriptor">Assaults</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    import * as localforage from 'localforage';

    export default {
        data () {
            return {
                year: (new Date()).getFullYear(),
                assaults: '',
                murders: '',
            }
        },
        mounted () {
            this.fetchData();
        },
        methods: {
            fetchData () {
                if (navigator.onLine) {
                    window.axios.get('/api/get-data/', {
                        headers: { 'Content-Type': 'application/json' }
                    })
                    .then(response => {
                        this.murders = response.data.murders;
                        this.assaults = response.data.assaults;

                        setTimeout(() => {
                            localforage.setItem('assaults', JSON.stringify(this.assaults)).then(() => {
                                return localforage.getItem('assaults');
                            })
                            .then((value) => {
                            })
                            .catch((err) => {
                            });

                            localforage.setItem('murders', JSON.stringify(this.murders)).then(() => {
                                return localforage.getItem('murders');
                            })
                            .then((value) => {
                            })
                            .catch((err) => {
                            });
                        }, 2000)
                    })
                    .catch(error => {
                        console.log('Error subscribing', error);
                    });
                } else {
                    localforage.getItem('assauls', (err, value) => {
                        let values = JSON.parse(value);

                        values.forEach(val => {
                            this.assaults = val;
                        });
                    });

                    localforage.getItem('murders', (err, value) => {
                        let values = JSON.parse(value);

                        values.forEach(val => {
                            this.murders = val
                        });
                    });
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .main {
        background-color: #7DA0B1;
    }
    .numbers {
        font-size: 3.5em;
        color: #d41b44;
    }
    .descriptor {
        font-size: 3em;
    }
    @media (max-width: 360px) {
        .heading-text {
            font-size: 3em;
        }
    }
    @media (max-width: 576px) {
        .heading-text {
            font-size: 3.5em;
        }
    }
    @media (max-width: 768px) {

    }
</style>