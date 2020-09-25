<template>
    <div class="row">
        <!-- Side Navigation -->
        <div class="col-sm-3">
            <div class="container">
                <div class="card">
                    <div class="card-body side-list">
                        <p @click="changeComponent('C#', $event)">C#</p>
                        <p @click="changeComponent('php', $event)">php</p>
                        <p @click="changeComponent('Python', $event)">Python</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Panel -->
        <div class="col-sm-9">
            <component v-bind:is="currentComponent"></component>
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Contents Component mounted.')
        },
        data() {
            return {
                lang: ''
            }
        },
        computed: {
            currentComponent() {
                let lang = this.lang
                let componentList = this.componentList
                let componentName = ""
                if(lang in componentList) {
                    componentName = componentList[lang]
                } else {
                    componentName = 'app-empty-content'
                }
                return componentName
            },
            componentList: () => {
                return {
                    'C#': 'app-cs-content',
                    'php': 'app-php-content',
                    'Python': 'app-python-content'
                }
            }
        },
        methods: {
            changeComponent(arg) {
                this.lang = arg
            }
        }
    }
</script>
