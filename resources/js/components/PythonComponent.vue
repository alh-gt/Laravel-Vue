<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                This is Python Page
            </div>

        <!-- This is the content deciding the nature of the footer -->
            <div class="card-body content">
                <p>{{ description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Python Component mounted.')
            axios.get("/api/lang/python").then(
                (response) => {
                    console.log(response)
                    this.description = response.data.data.description
                }
            )
            // console.log(response.data)
            // this.description = result.data.description
        },
        data() {
            return {
                description: "now loading"
            }
        }
    }
</script>
