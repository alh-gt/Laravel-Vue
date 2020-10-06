<template>
    <div class="container">
        <template v-if="isRead">
            <div class="card">
                <div class="card-header">
                    This is {{ name }} Page
                </div>

            <!-- This is the content deciding the nature of the footer -->
                <div class="card-body content">
                    <p>{{ description }}</p>
                </div>
            </div>
            <div v-if="langId != 0" class="card-footer text-right">
                <button class="btn btn-danger" type="submit" @click="deleteLanguage(langId)">Delete</button>
                <button class="btn btn-success" type="submit" @click="changeMode('edit')">Edit</button>
            </div>
        </template>
        <template v-if="isEdit">
            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <input type="text" class="form-control" v-bind:class="{'is-invalid': isInvalidName}" id="exampleFormControlInput1" placeholder="Python" v-model="name" v-bind:readonly="isEdit">
                        <div class="invalid-feedback">{{ nameError }}</div>
                    </div>
                </div>

            <!-- This is the content deciding the nature of the footer -->
                <div class="card-body content">
                    <div class="form-group">
                        <textarea class="form-control" v-bind:class="{'is-invalid': isInvalidDescription}" id="exampleFormControlTextarea1" rows="3" v-model="description"></textarea>
                        <div class="invalid-feedback">{{ descriptionError }}</div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" @click="submit">{{ buttonText }}</button>
                    </div>
                </div>
            </div>
        </template>
        <template v-if="isAdd">
            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <input type="text" class="form-control" v-bind:class="{'is-invalid': isInvalidName}" id="exampleFormControlInput1" placeholder="Python" v-model="name" v-bind:readonly="isEdit">
                        <div class="invalid-feedback">{{ nameError }}</div>
                    </div>
                </div>

            <!-- This is the content deciding the nature of the footer -->
                <div class="card-body content">
                    <div class="form-group">
                        <textarea class="form-control" v-bind:class="{'is-invalid': isInvalidDescription}" id="exampleFormControlTextarea1" rows="3" v-model="description"></textarea>
                        <div class="invalid-feedback">{{ descriptionError }}</div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" @click="submit">{{ buttonText }}</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Language Component mounted.')
        },
        data() {
            return {
                name: 'empty',
                description: 'Plese choose any left menu',
                nameError: '',
                descriptionError: '',
            }
        },
        props: {
            langId: {
                type: Number,
                required: true
            },
            mode: {
                type: String,
                required: true
            },
            changeMode: {
                type: Function,
                required: true
            },
            resetLangId: {
                type: Function,
                required: true
            }
        },
        methods: {
            getLanguage() {
                axios.get('/lang/'+this.langId).then(
                    (response) => {
                        this.language = response.data.data
                        this.name = this.language.name
                        this.description = this.language.description
                    }
                )
            },
            submit: function() {
                if(this.name == '') {
                    this.nameError = '言語名が未入力です。'
                } else {
                    this.nameError = ''
                }

                if(this.description == '') {
                    this.descriptionError = '言語の説明が未入力です。'
                } else {
                    this.descriptionError = ''
                }

                if(this.isInvalidName || this.isInvalidDescription) {
                    return
                }
                this.save(this.name, this.description)
            },
            save: function(name, description) {
                let param = {
                    name: name,
                    description: description
                };
                if(this.isEdit) {
                    axios.put('/lang/'+this.langId, param)
                    .then((response) => {
                        console.log(response)
                        this.$emit('success', this.langId)
                        this.changeMode('read')
                    })
                    .catch((response) => {
                        this.nameError = _.join(response.response.data.errors.name, '<br>')
                        this.descriptionError = _.join(response.response.data.errors.description, '<br>')
                    })
                } else {
                    axios.post('/lang', param)
                    .then((response) => {
                        console.log(response)
                        this.nameError = ''
                        this.descriptionError = ''
                        this.$emit('success', response.data.data.id)
                        this.changeMode('read')
                    })
                    .catch((response) => {
                        this.nameError = _.join(response.response.data.errors.name, '<br>')
                        this.descriptionError = _.join(response.response.data.errors.description, '<br>')
                    })
                }
            },
            editLanguage() {
                console.log('editLanguage')
                this.changeMode('edit')
            },
            deleteLanguage() {
                console.log('deleteLanguage')
                axios.delete('/lang/'+this.langId).then(
                    (response) => {
                        this.name = 'empty'
                        this.description = 'Plese choose any left menu'
                        this.resetLangId()
                    }
                )
            }
        },
        computed: {
            buttonText() {
                let text = ""
                if(this.mode == 'add') {
                    text = '登録'
                } else if(this.mode == 'edit') {
                    text = '更新'
                }
                return text
            },
           isEdit() { return this.mode == 'edit' },
           isAdd() { return this.mode == 'add' },
           isRead() { return this.mode == 'read' },
           isInvalidName() { return this.nameError != '' },
           isInvalidDescription() { return this.descriptionError != '' }
        },
        watch: {
            langId(newLangId) {
                console.log(this.langId)
                if(newLangId != 0){
                    this.getLanguage()
                }
            },
            mode() {
                if(this.isAdd) {
                    this.name = ''
                    this.description = ''
                }
            }

        }
    }
</script>
