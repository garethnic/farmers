<template>
    <main>
        <section>
            <div class="container">
                <div class="row mt-5 mx-auto justify-content-center align-content-center">
                    <div class="col text-center">
                        <h1>Farm Attacks</h1>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container h-100 mx-auto d-flex">
                <div class="row mt-4 mx-auto">
                    <div class="col text-center">
                        <div class="container d-flex flex-column">
                            <div class="row mx-auto">
                                <div class="col numbers">70</div>
                            </div>
                            <div class="row">
                                <div class="col descriptor">Murders</div>
                            </div>
                        </div>
                        <div class="container mt-5 d-flex flex-column">
                            <div class="row mx-auto">
                                <div class="col numbers">341</div>
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
    export default {
        data () {
            return {
                message: 'hello'
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
</style>