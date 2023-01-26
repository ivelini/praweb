<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Продукт</title>

        <style>
            .category-list * {transition: .4s linear;}
            .category-list {
                background: white;
                list-style-type: circle;
                list-style-position: inside;
                padding: 0 10px;
                margin: 0;
            }
            .category-list li {
                font-family: "Trebuchet MS", "Lucida Sans";
                border-bottom: 1px solid #efefef;
                padding: 10px 0;
            }
            .category-list a {
                text-decoration: none;
                color: #555;
            }
            .category-list li span {
                float: right;
                display: inline-block;
                border: 1px solid #efefef;
                padding: 0 5px;
                font-size: 13px;
                color: #999;
            }
            .category-list li:hover a {color: #c93961;}


            .dbl-border {
                list-style: none;
                margin: 0;
            }
            .dbl-border li {
                margin: 10px 0;
                position: relative;
            }
            .dbl-border li:before {
                content: "";
                width: 6px;
                height: 40%;
                background: #EFDD89;
                position: absolute;
                top: 30%;
                left: -12px;
            }
            .dbl-border a:hover {background: #D4D8D9;}
        </style>

        <style>
            .modalDialog {
                position: fixed;
                font-family: Arial, Helvetica, sans-serif;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: rgba(0,0,0,0.8);
                z-index: 99999;
                -webkit-transition: opacity 400ms ease-in;
                -moz-transition: opacity 400ms ease-in;
                transition: opacity 400ms ease-in;
                display: none;
                pointer-events: none;
            }

            .modalDialog:target {
                display: block;
                pointer-events: auto;
            }

            .modalDialog > div {
                width: 400px;
                position: relative;
                margin: 10% auto;
                padding: 5px 20px 13px 20px;
                border-radius: 10px;
                background: #fff;
                background: -moz-linear-gradient(#fff, #999);
                background: -webkit-linear-gradient(#fff, #999);
                background: -o-linear-gradient(#fff, #999);
            }

            .close {
                background: #606061;
                color: #FFFFFF;
                line-height: 25px;
                position: absolute;
                right: -12px;
                text-align: center;
                top: -10px;
                width: 24px;
                text-decoration: none;
                font-weight: bold;
                -webkit-border-radius: 12px;
                -moz-border-radius: 12px;
                border-radius: 12px;
                -moz-box-shadow: 1px 1px 3px #000;
                -webkit-box-shadow: 1px 1px 3px #000;
                box-shadow: 1px 1px 3px #000;
            }

            .close:hover { background: #00d9ff; }
        </style>
        <script src="https://unpkg.com/vue@next"></script>

    </head>
    <body class="antialiased">
    <div id="app">
        <list-component
            :options="options">
        </list-component>

    </div>



    </body>
    <script>
        let data = {
            data() {
                return {
                    options: null
                }
            },
            mounted() {
                this.getProduct()
            },
            methods: {
                async getProduct() {
                    let pathname = (new URL(window.location.href)).pathname
                    let id = pathname.slice(pathname.indexOf('/', 1) + 1)

                    let response = await fetch('http://127.0.0.1:8000/api/product/' + id)
                    this.options = await response.json()

                    console.log(this.options)

                }
            }
        }

        let listComponent = {
            props: ['options'],
            data() {
                return {
                    option: {
                        id: null,
                        name: null
                    }
                }
            },
            template: `<ul class="category-list">
                            <li v-for="(optionGroup, index) in options">
                                @{{ index }}
                                <ul class="dbl-border">
                                    <li v-for="(option, index) in optionGroup">
                                        <div style="width: 100%; overflow: hidden">
                                            <div style="width: 50%; float: left">
                                                @{{ index }}
                                            </div>
                                            <div style="width: 30%; float: left">
                                                @{{ option[0].name }}
                                            </div>
                                            <div style="width: 20%; float: left">
                                                <a href="#openModal" @click="this.option.id = option[0].id; this.option.name = option[0].name">изменить</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <popup-component
                            :id="option.id"
                            :name="option.name"></popup-component>`
        }

        let popupComponent = {
            emits: ['setUpdate'],
            props: ['id', 'name'],
            data() {
                return {
                    option: {
                        id: null,
                        editName: null
                    }
                }
            },
            methods: {
                async updateOption() {
                    this.option.id = this.id
                    let response = await fetch('http://127.0.0.1:8000/api/product/' + this.id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(this.option)
                    })

                    let result = await response.json()
                    if (result.status == 'OK') location.reload()
                }
            },
            template: `<div id="openModal" class="modalDialog">
                            <div>
                                <a href="#close" title="Закрыть" class="close">X</a>
                                <h2>Изменить опцию с ID: @{{ id }}</h2>
                                <input type="text"
                                    :value="name"
                                     @input="option.editName = $event.target.value">
                                <a href="#close" @click="updateOption">Сохранить</a>
                            </div>
                        </div>`

        }

        let app = Vue.createApp(data)
        app.component('list-component', listComponent)
        app.component('popup-component', popupComponent)
        app.mount('#app')
    </script>
</html>
