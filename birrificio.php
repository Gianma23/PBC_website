<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/html/head.php"; ?>

    <title>Birrificio - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/html/header.php"; ?>

    <main>
        <section class="hero">
            <div class="container">
                <div class="heading-subheading">
                    <h1 class="hero__title fw-bold">Il Birrificio</h1>
                    <h2 class="subheading">Quarta sede in 10 anni</h2>
                </div>

                <ul class="novita-list">
                    <li class="novita-list__item"><strong>190 hL</strong> di cantina</li>
                    <li class="novita-list__item"><strong>10 hL</strong> di doppia cotta</li>
                    <li class="novita-list__item"><strong>2000 hL</strong> prodotti nel <strong>2019</strong></li>
                    <li class="novita-list__item"><strong>Laboratorio</strong> di controllo qualità</li>
                </ul>

                <ul class="image-show">
                    <li class="image-show__item"><img src="global/02-images/birrificio/fermentatori-1200x801.png" alt="sala luminosa con fermentatori su tutte le pareti"></li>
                    <li class="image-show__item"><img src="global/02-images/birrificio/analisi-600x401.png" alt="ragazzo che analizza con delle provette la birra"></li>
                    <li class="image-show__item"><img src="global/02-images/birrificio/analisi-2-600x401.png" alt="ragazza in laboratorio che analizza la birra"></li>
                    <li class="image-show__item"><img src="global/02-images/birrificio/imbottigliamento-2-600x401.png" alt="ragazzo che usa la macchina di imbottigliamento"></li>
                    <li class="image-show__item"><img src="global/02-images/birrificio/etichette-600x401.png" alt="etichette per le birre impilate"></li>
                </ul>

                <button type="button" class="button button--hero">VISITA IL BIRRIFICIO</button>
                <p>Nella nostra nuova sede produciamo birre di carattere ed espressive,
                    unendo la realtà labronica con altre realtà esterne. Produciamo sia una linea di
                    birre continuative, per appagare tutto l’anno la sete dei nostri clienti, sia linee
                    a edizione limitata, come le ‘one shot’, le stagionali e le birre nate da collaborazioni.</p>
            </div>
        </section>

        <section class="visite">
            <div class="container center">
                <h2 class="primary-heading">Vieni a trovarci</h2>
                <div class="section-container">

                    <article class="degusta-visita">
                        <div class="tile-section tile-section--left">
                            <div class="tile-section__content">
                                <h3>Degustazione e Visita</h3>
                                <p><strong class="prezzo">Prezzo: 40&euro;</strong><br>
                                    Degustazione di 4 birre da 0.28 cL l’una, in abbinamento al nostro tagliere di formaggi
                                    e salumi selezionati – o in alternativa solo salumi/formaggi – in più una visita guidata
                                    completa del birrificio con spiegazione del processo produttivo. <strong>Durata: circa 45 minuti.</strong></p>
                                <button type="button" class="button button--shop">AGGIUNGI</button>
                            </div>
                            <div class="tile-section__img-container">
                                <img src="global/02-images/birrificio/corso-768x513.jpg" alt="Due persone che spiegano ad un corso di degustazione">
                            </div>
                        </div>
                    </article>

                    <article class="degusta">
                        <div class="tile-section tile-section--right">
                            <div class="tile-section__content">
                                <h3>Degustazione</h3>
                                <p><strong class="prezzo">Prezzo: 20&euro;</strong><br>
                                    Degustazione di 4 birre da 0.28 cL l’una, in abbinamento al nostro tagliere di
                                    formaggi e salumi selezionati (in alternativa solo salumi oppure formaggi).</p>
                                <button type="button" class="button button--shop">AGGIUNGI</button>
                            </div>
                            <div class="tile-section__img-container">
                                <img src="global/02-images/birrificio/botti-mastro-600x401.png" alt="Botti contenenti la birra mastro ciliegia">
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        <section class="premi">
            <div class="container center">
                <h2 class="primary-heading">I nostri premi</h2>
                <ul class="premi-list">
                    <li class="premi-list__item">
                        <p>Fusto Slow Food Guida alle birre d'Italia 2019<br>
                            <span class="parenthesis">(elevata qualità su tutta la produzione, soprattutto con le birre di grande beva)</span></p>
                    </li>
                    <li class="premi-list__item">
                        <p>Bottiglia Slow Food Guida alle birre d’Italia 2017<br>
                            <span class="parenthesis">(alta qualità media della produzione in bottiglia)</span></p>
                    </li>
                    <li class="premi-list__item">
                        <p>Bottiglia Slow Food Guida alle birre d’Italia 2015<br>
                            <span class="parenthesis">(alta qualità media della produzione in bottiglia)</span></p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="collab-progetti">
            <div class="container">
                <h2 class="primary-heading">Collaborazioni e progetti</h2>

                <section class="scuole-uni">
                    <h3 class="secondary-heading">Scuole ed Università</h3>

                    <img class="tile-section__deg-visita__img" src="" alt="Due persone che spiegano ad un corso di degustazione">
                </section>

                <section class="murali">
                    <h3 class="secondary-heading">Progetto Murali</h3>
                    <p class="fs-500 fw-semibold">Una birra con etichetta “speciale” in edizione limitata per ogni murales che dà colore alla nostra città!</p>
                    <img class="tile-section__degusta__img" src="" alt="Processo di imbottigliamento">
                </section>

            </div>
        </section>
    </main>
    <?php include "global/html/footer.php"; ?>
</body>
</html>