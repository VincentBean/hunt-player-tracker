<template>
    <canvas id="map" style="width: 750px; height: 750px;"/>
</template>

<script>
export default {
    name: "Map",

    data() {
        return {
            canvas: null,
            ctx: null,
            mapName: '',
            scale: 1,

            vertices: {
                'bayou': {
                    'ASF': {x: 102, y: 109, name: "Alain & Son's Fish"},
                    'ASF_SP1': {x: 87, y: 59, name: "Alain & Son's Fish SP 1"},
                    'ASF_SP2': {x: 43, y: 121, name: "Alain & Son's Fish SP 2"},


                    'RML': {x: 248, y: 103, name: 'Reynard Mill & Lumber'},
                    'RML_SP1': {x: 226, y: 4, name: 'Reynard Mill & Lumber SP 1'},
                    'RML_SP2': {x: 317, y: 12, name: 'Reynard Mill & Lumber SP 2'},

                    'PR': {x: 480, y: 133, name: 'Port Reeker'},
                    'PR_SP1': {x: 412, y: 14, name: 'Port Reeker SP 1'},

                    'SL': {x: 618, y: 92, name: 'Scupper Lake'},
                    'SL_SP1': {x: 561, y: 16, name: 'Scupper Lake SP 1'},
                    'SL_SP2': {x: 711, y: 45, name: 'Scupper Lake SP 2'},

                    'DL': {x: 343, y: 203, name: 'Darrow Livestock'},

                    'BG': {x: 164, y: 311, name: 'Blanchett Graves'},
                    'BG_SP1': {x: 32, y: 412, name: 'Blanchett Graves SP 1'},
                    'BG_SP2': {x: 35, y: 290, name: 'Blanchett Graves SP 2'},
                    'BG_SP3': {x: 29, y: 213, name: 'Blanchett Graves SP 3'},

                    'LD': {x: 324, y: 367, name: 'Lockbay Docks'},
                    'AF': {x: 430, y: 293, name: 'Alice Farm'},

                    'CMN': {x: 663, y: 263, name: 'The Chapel of Madonna Noire'},
                    'CMN_SP1': {x: 717, y: 193, name: 'The Chapel of Madonna Noire SP 1'},
                    'CMN_SP2': {x: 728, y: 343, name: 'The Chapel of Madonna Noire SP 2'},

                    'SB': {x: 568, y: 445, name: 'Stillwater Bend'},
                    'SB_SP1': {x: 696, y: 474, name: 'Stillwater Bend SP 1'},

                    'HWC': {x: 405, y: 532, name: 'Healing-Waters Church'},
                    'PC': {x: 247, y: 521, name: 'Pitching Crematorium'},

                    'CH': {x: 72, y: 613, name: 'Cyprus Huts'},
                    'CH_SP1': {x: 94, y: 714, name: 'Cyprus Huts SP 1'},
                    'CH_SP2': {x: 21, y: 536, name: 'Cyprus Huts SP 2'},

                    'DR': {x: 231, y: 680, name: 'Davant Ranch'},
                    'DR_SP1': {x: 327, y: 734, name: 'Davant Ranch SP 1'},
                    'DR_SP2': {x: 154, y: 715, name: 'Davant Ranch SP 2'},

                    'SH': {x: 429, y: 691, name: 'The Slaughterhouse'},
                    'SH_SP1': {x: 523, y: 728, name: 'The Slaughterhouse SP 1'},

                    'CG': {x: 623, y: 616, name: 'Catfish Grove'},
                    'CG_SP1': {x: 726, y: 613, name: 'Catfish Grove SP 1'},
                    'CG_SP2': {x: 633, y: 712, name: 'Catfish Grove SP 2'},
                },
                'delta': {
                    'GD': {x: 84, y: 106, name: "Godard Docks"},
                    'GD_SP1': {x: 6, y: 157, name: "Godard Docks SP1"},
                    'GD_SP2': {x: 108, y: 14, name: "Godard Docks SP2"},

                    'BB': {x: 243, y: 109, name: "Blanc Brinery"},
                    'BB_SP1': {x: 235, y: 7, name: ""},

                    'GA': {x: 463, y: 112, name: "Golden Acres"},
                    'GA_SP1': {x: 355, y: 16, name: ""},
                    'GA_SP2': {x: 498, y: 14, name: ""},

                    'SP': {x: 611, y: 150, name: "Salter's Pork"},
                    'SP_SP1': {x: 611, y: 21, name: ""},
                    'SP_SP2': {x: 691, y: 106, name: ""},
                    'SP_SP3': {x: 689, y: 200, name: ""},

                    'MB': {x: 133, y: 317, name: "Maw Battery"},
                    'MB_SP1': {x: 23, y: 287, name: ""},

                    'LS': {x: 363, y: 198, name: "Lawson Station"},
                    'AP': {x: 546, y: 310, name: "Arden Parish"},

                    'WR': {x: 663, y: 420, name: "Windy Run"},
                    'WR_SP1': {x: 704, y: 328, name: ""},
                    'WR_SP2': {x: 704, y: 508, name: ""},

                    'NP': {x: 505, y: 434, name: "Nocholls Prison"},
                    'SF': {x: 352, y: 315, name: "Sweetbell Flour"},
                    'FC': {x: 232, y: 438, name: "Fort Carmick"},

                    'IW': {x: 74, y: 478, name: "Iron Works"},
                    'IW_SP1': {x: 17, y: 434, name: ""},
                    'IW_SP2': {x: 20, y: 542, name: ""},

                    'WA': {x: 142, y: 596, name: "Wolfshead Arsenal"},
                    'WA_SP1': {x: 24, y: 632, name: ""},
                    'WA_SP2': {x: 127, y: 720, name: ""},

                    'BCB': {x: 298, y: 670, name: "Bradley & Craven Brickworks"},
                    'BCB_SP1': {x: 233, y: 716, name: ""},
                    'BCB_SP2': {x: 318, y: 719, name: ""},

                    'CAL': {x: 461, y: 559, name: "C&A Lumber"},
                    'CAL_SP1': {x: 475, y: 712, name: ""},

                    'HH': {x: 613, y: 572, name: "Hemlock and Hide"},
                    'HH_SP1': {x: 614, y: 709, name: ""},
                    'HH_SP2': {x: 695, y: 614, name: ""},
                }

            },

            vertexData: [],
            edges: []
        }
    },

    mounted() {
        this.canvas = document.getElementById('map')
        this.ctx = this.canvas.getContext('2d')

        let self = this;
        this.canvas.addEventListener('mousedown', function (event) {
            const rect = self.canvas.getBoundingClientRect()
            const x = event.clientX - rect.left
            const y = event.clientY - rect.top

            self.ctx.fillStyle = "#00FF00";
            self.ctx.fillRect(x, y, 10, 10);

            console.log("x: " + x + " y: " + y);
        }, false);

        Echo.channel('lobby.' + this.$parent.getLobby())
            .listen('UpdateMap', (data) => {

                self.vertexData = data.vertices
                self.edges = data.edges

                self.$parent.updateControls(data.vertices)
                self.resetMap()

            })
    },

    methods: {
        resetMap() {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

            this.drawMap(this.mapName)
        },

        drawVertices() {
            let vertices = this.vertices[this.mapName];

            for (const code in vertices) {
                let data = vertices[code];

                let weight = this.getVertexWeight(code)

                if (weight > 0) {
                    this.ctx.font = "20px Arial"
                    this.ctx.fillStyle = "#FFFFFF"
                    this.ctx.shadowBlur = 7;
                    this.ctx.lineWidth = 5;
                    this.ctx.shadowColor = "black";

                    let text = this.getVertexWeight(code) + " (" + this.getVertexPercent(code) + "%)";

                    this.ctx.fillText(text, data.x - 60, data.y + 30)
                }


                this.ctx.fillStyle = this.getVertexColor(code);
                this.ctx.fillRect(data.x - 5, data.y - 5, 10, 10);
            }
        },

        getVertexColor(code) {
            if (code.includes('_SP'))
                return '#00FF00'

            let data = this.getVertexData(code)

            if (data != null && data.excluded)
                return '#000000'


            if (data != null && data.area == 1)
                return '#0000FF'

            return '#FF0000'
        },

        getVertexWeight(code) {
            let data = this.getVertexData(code)

            if (data == null) return 0

            return Math.round(data.weight * 100) / 100
        },

        getVertexPercent(code) {
            let data = this.getVertexData(code)

            if (data == null || data.percent == undefined)
                return 0

            return data.percent
        },

        getVertexData(code) {
            for (const vertex in this.vertexData) {
                let data = this.vertexData[vertex]

                if (data.code == code) {
                    return data;
                }

            }

            return null
        },

        drawEdges() {
            for (const index in this.edges) {
                let edge = this.edges[index]
                this.drawEdge(edge)
            }
        },

        drawEdge(edge) {
            let startVertex = this.getByCode(edge.a)
            let endVertex = this.getByCode(edge.b)

            this.ctx.beginPath()

            this.ctx.moveTo(startVertex.x, startVertex.y)
            this.ctx.lineTo(endVertex.x, endVertex.y)

            this.ctx.stroke()

            if (edge.dir == '=')
                return

            let dx = endVertex.x - startVertex.x
            let dy = endVertex.y - startVertex.y

            let radian = Math.atan2(dy, dx)

            this.ctx.save()

            let middle = this.getMiddle(startVertex.x, startVertex.y, endVertex.x, endVertex.y)
            this.ctx.font = "20px Arial"
            this.ctx.fillStyle = "#FFFFFF"
            this.ctx.textAlign = 'center'
            this.ctx.translate(middle.x, middle.y)
            this.ctx.rotate(radian)
            this.ctx.fillText(edge.dir, 0, 10)

            this.ctx.restore()
        },

        getMiddle(x1, y1, x2, y2) {
            return {x: (x1 + x2) / 2, y: (y1 + y2) / 2};
        },

        getByCode(code) {
            let vertices = this.vertices[this.mapName]

            return vertices[code]
        },

        drawMap(mapName, callback) {
            this.mapName = mapName;
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height)

            this.ctx.canvas.width = 750;
            this.ctx.canvas.height = 750;

            let img = new Image()
            let self = this;
            img.onload = function () {
                self.ctx.drawImage(img, 0, 0)

                self.drawEdges()
                self.drawVertices()
            }

            img.src = '/storage/' + mapName + '.png'
            this.ctx.scale(this.scale, this.scale)
        },

        getScaled(src) {
            return src * this.scale;
        }
    }
}
</script>
