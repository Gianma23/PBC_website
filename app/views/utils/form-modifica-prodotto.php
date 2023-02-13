<form method="POST" enctype="multipart/form-data" id="prodotto-form" novalidate>
    <input type="hidden" name="action" value="<?= $action?>">
    <p class="form-elem">
        <label for="nome">Nome*:</label><br>
        <input type="text" id="nome" name="nome" required <?php if($action == 'SALVA') echo 'readonly'?>>
        <small class="error"></small>
    </p>
    <p class="form-elem">
        <label for="tagline">Tag-line:</label><br>
        <input type="text" id="tagline" name="tagline">
        <small class="error"></small>
    </p>
    <p class="form-elem">
        <label for="desc">Descrizione*:</label><br>
        <textarea id="desc" name="desc" required></textarea>
        <small class="error"></small>
    </p>

    <div class="form-3col">
        <p class="form-elem">
            <label for="prezzo">Prezzo*:</label><br>
            <input type="number" step="0.01" id="prezzo" name="prezzo" required>
            <small class="error"></small>
        </p>
        <p class="form-elem">
            <label for="quantita">Quantità*:</label><br>
            <input type="number" id="quantita" name="quantita" required>
            <small class="error"></small>
        </p>
        <p class="form-elem">
            <label for="categoria">Categoria:</label><br>
            <select id="categoria" name="categoria" required>
                <option value="birra">Birra</option>
                <option value="merchandising">Merchandising</option>
                <option value="altro">Altro</option>
            </select>
            <small class="error"></small>
        </p>
    </div>

    <div id="info-birra">
        <p class="form-elem">
            <label for="stile">Stile*:</label><br>
            <input type="text" id="stile" name="stile" required>
            <small class="error"></small>
        </p>
        <div class="form-2col">
            <p class="form-elem">
                <label for="aroma">Aroma*:</label><br>
                <textarea id="aroma" name="aroma" required></textarea>
                <small class="error"></small>
            </p>
            <p class="form-elem">
                <label for="gusto">Gusto*:</label><br>
                <textarea id="gusto" name="gusto" required></textarea>
                <small class="error"></small>
            </p>
        </div>
    </div>

    <p class="form-elem">
        <label for="image">Immagine*:</label><br>
        <input type="file" id="image" name="image" required>
        <small class="error"></small>
    </p>
    <p>
        <button type="submit" class="button"><?= $action?></button>
        <small class="error" id="error-prodotto"></small>
    </p>
</form>