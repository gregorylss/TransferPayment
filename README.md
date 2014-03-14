Transfer Payment Module
=======================
author: Thelia <info@thelia.net>

Summary
-------

fr_FR:
1.  Installation
2.  Utilisation
3.  Boucle
4.  Intégration

en_US:
1.  Install notes
2.  How to use
3.  Loop
4.  Integration


fr_FR
-----

### Installation

Pour installer le module de paiement par virement, téléchargez l'archive et décompressez la dans ```<dossier de thelia>/local/modules```

### Utilisation

Tout d'abord, activez le module dans le Back-Office, onglet "Modules", puis cliquez sur "Configurer" sur la ligne du module.
Entrez vos informations bancaires et enregistrez.

### Boucle
1.  transfer.get.info
    - Arguments:
        1. order_id | obligatoire | id de la commande
    - Sorties:
        1. \$KEY: nom de l'information ( iban, swift, raison sociale )
        2. \$VALUE: Valeur de l'information
    - Utilisation:
        ```{loop type="transfer.get.info" name="yourloopname" order_id=$ID}
            {\$KEY}: {\$VALUE}
        {/loop}```


### Intégration

Les informations bancaires du commerçant sont affichées sur la page order-placed.html,
un exemple d'intégration est proposé pour le thème par défault de Thelia.
Il vous suffit de copier le(s) fichier(s) contenu(s) dans ```<dossier du module>/templates/frontOffice/default```
dans ```<dossier de Thelia>/templates/frontOffice/default```

en_US
-----

### Install notes

To install the transfer payment module, download the archive and uncompress it in ```<path to thelia>/local/modules```

### How to use

You first need to activate the module in the Back-Office, tab "Modules". Then click on "Configure" on the line of the module.
Enter you Bank account information and save.

### Loop
1.  transfer.get.info
    - Arguments:
        1. order_id | mandatory | id of the order
    - Output:
        1. \$KEY: name of the information ( iban, swift, company name )
        2. \$VALUE: Value of the information
    - Usage:
        ```{loop type="transfer.get.info" name="yourloopname" order_id=$ID}
            {\$KEY}: {\$VALUE}
        {/loop}```


### Integration

The bank account information are displayed on "order-placed.html".
An integration example is available for the default Thelia theme.
You only have to copy the file(s) of ```<path to module>/templates/frontOffice/default```
in ```<path to Thelia>/templates/frontOffice/default```
