<template>
    <div class="row">
        <!-- Side Navigation -->
        <div class="col-sm-3">
            <div class="container">
                <div class="card">
                    <div class="card-body side-list">
                        <p v-for="lang in languages" :key="lang.id" @click="changeLanguage(lang.id)">{{ lang.name }}</p>
                        <p @click="changeMode('add')">追加 ＋</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Panel -->
        <div class="col-sm-9">
                <app-language
                    key="langId"
                    :langId="langId"
                    :mode="mode"
                    :changeMode="changeMode"
                    :resetLangId="resetLangId"
                    @success="addSuccess"></app-language>
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Contents Component mounted.')
            this.getLanguage()
        },
        data() {
            return {
                lang: '',
                languages: [],
                langId: 0,
                mode: 'read'
            }
        },
        methods: {
            getLanguage() {
                axios.get("/lang").then(
                    (response) => {
                        this.languages = response.data.data
                    }
                )
            },
            changeMode(mode) {
                this.mode = mode;
            },
            changeLanguage(arg) {
                this.langId = parseInt(arg)
                this.changeMode('read')
            },
            addSuccess(langId) {
                this.getLanguage()
                this.langId = langId
                this.isEdit = false
            },
            editClicked() {
                this.isEdit = true
            },
            resetLangId() {
                this.langId = 0
                this.getLanguage()
            }
        },
    }
</script>
