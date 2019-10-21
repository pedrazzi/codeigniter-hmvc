<div id="search">
    <modal v-if="searchShow" @close="searchShow = false" css="bg-gray">
        <div class="modal-header">
            <h4 class="modal-title text-dark">Pesquisar Imóveis</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body bg-light text-dark">
            <div class="form-row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <select v-model="form.state" id="state" name="state" class="form-control mb-2">
                            <option value="">Estados</option>
                            <option v-for="item in menu.states" :value="item.id" :data-name="item.name">{{item.id}} ({{item.total}})</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="form-group">
                        <select v-model="form.city" id="city" name="city" class="form-control mb-2">
                            <option value="">Cidades</option>
                            <option v-for="item in menu.cities" :value="item.id" :data-name="item.name">{{item.id}} ({{item.total}})</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="form-group">
                        <select v-model="form.bairro" id="bairro" name="bairro" class="form-control mb-2">
                            <option value="">Bairros</option>
                            <option v-for="item in menu.bairros" :value="item.id" :data-name="item.name">{{item.name}} ({{item.total}})</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <select v-model="form.order" id="order" name="order" class="form-control mb-2">
                    <option value="">Ordenar</option>
                    <option v-for="item in menu.orders" :value="item.id">{{item.name}}</option>
                </select>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <select v-model="form.forma" id="forma" name="forma" class="form-control mb-2">
                            <option value="">Imóveis para</option>
                            <option v-for="item in menu.formas" :value="item.id" :data-name="item.name">{{item.name}} ({{item.total}})</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select v-model="form.tipo" id="tipo" name="tipo" class="form-control mb-2">
                            <option value="">Tipos de Imóveis</option>
                            <option v-for="item in menu.tipos" :value="item.id" :data-name="item.name">{{item.name}} ({{item.total}})</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <select v-model="form.quarto" id="quarto" name="quarto" class="form-control mb-2">
                            <option value="">Nº de Quartos</option>
                            <option v-for="item in menu.quartos" :value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select v-model="form.wc" id="wc" name="wc" class="form-control mb-2">
                            <option value="">Nº de WC Social</option>
                            <option v-for="item in menu.wcs" :value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-label-group">
                        <money v-model="form.price_min" id="price_min" name="price_min"></money>
                        <label class="text-right" for="price_min">Preço Mínimo</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label-group">
                        <money v-model="form.price_max" id="price_max" name="price_max"></money>
                        <label class="text-right" for="price_max">Preço Máximo</label>
                    </div>
                </div>
            </div>
            <button @click.stop="submit" class="btn btn-danger btn-block"><i class="fa fa-search fa-lg"></i></button>
        </div>
    </modal>
</div>