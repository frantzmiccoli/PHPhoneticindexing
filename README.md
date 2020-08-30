[![Build Status](https://secure.travis-ci.org/frantzmiccoli/PHPhoneticindexing.png)](http://travis-ci.org/frantzmiccoli/PHPhoneticindexing)

Scope
===

We try to provide different languages phonetic indexing methods.

* English: uses the PHP Standard Library `soundex()`
* German: uses a custom implementation of the Cologne phonetic indexing 
algorithm. https://en.wikipedia.org/wiki/Cologne_phonetics
* French: uses a custom algorithm (see below)

Installation
===

```
composer require frantzmiccoli/phphoneticindexing
```

Usage
===

```
use PhPhoneticIndexing\GetPhoneticIndex;

$getPhoneticIndex = new GetPhoneticIndex();

var_dump($getPhoneticIndex->getPhoneticIndex('carabine', 'fr')); // karabyn
```

Please note that if you wish to support new languages, those can be added using
`$getPhoneticIndex->addLanguage()`.


French implementation
===

| Root class  | Pattern                      | Replacement | Example          |
| ----------- | -----------------------      | ----------- | -----------      |
| z           | [aeiouy]s[aeiouy]            | z           | hasard           |
| 3           | è                            | 3           | très             |
| 3           | é                            | 3           | était            |
| 3           | ai                           | 3           | était            |
| 3           | e[rtx]$                      | 3           | est rentrer      /
| 3           | ^est$                        | 3           | est rentrer      /
| 3           | e[rt] following letter kept  | 3           | errance          /
| 3           | es[^$] following letter kep  | 3           | brest            /
| 3           | ez$                          | 3           | est rentrer      /
| o           | o                            | o           | orange           |
| o           | au                           | o           | aubagne          |
| a           | a                            | a           | abracadra        |
| a           | oi[e]                        | a           | oie              |
| b           | b                            | b           | abolition        |
| b           | p                            | b           | problème         |
| 1           | `[iu][nm]([^mnaeiouy123])`   | 1           | obtint emprunt   |
| 1           | em*ent*                      | 1           | lentement        |
| -           | ent$                         | -           | vouent           |
| 1           | en                           | 1           | enfant           |
| 1           | em                           | 1           | emprunter        |
| 1           | an                           | 1           | enfant           |
| f           | f                            | f           | fenêtre          |
| f           | ph                           | f           | sophisme         |
| f           | v                            | v           | savourer         |
| e           | e[^$]                        | e           | f**e**nêtre      |
| e           | eu                           | e           | eux              |
| e           | o?eu?                        | e           | oeuvre oedême    |
| 2           | o[nm][^nmaeiouy123]          | 2           | attention ombre  |
| j           | j                            | j           | juger            |
| j           | g[ei]                        | j           | juger gironde    |
| j           | ch                           | j           | chercher         |
| j           | sh                           | j           | sherpa           |
| y           | ill                          | i           | briller          |
| y           | i                            | i           | cession          |
| y           | y                            | i           | cession          |
| s           | s                            | s           | sérieux          |
| s           | c[ei]                        | s           | cession          |
| s           | ç                            | s           | ça               |
| k           | g[^ei]                       | k           | gué gardien      |
| k           | k                            | k           | karaté           |
| k           | c                            | k           | caramel          |
| k           | qu                           | k           | que              |
| u           | ou                           | u           | oublie           |
| u           | u                            | u           | ubuesque         |
| -           | [depqrstwxz]$                | -           | camp             |
| -           | e$                           | -           | oedême aiment    |
| -           | h                            | -           | habituer         |


0. Remove numbers and work in lower case.
1. Proceed with substitution in the given order.
2. Remove duplicates
3. Remove `-`
4. If wished remove `aeiouy123`

