Scope
===

We try to provide different languages phonetic index methods.

* English: uses the PHP Standard Library `soundex()`
* German: uses a custom implementation of the Cologne phonetic indexing 
algorithm. https://en.wikipedia.org/wiki/Cologne_phonetics
* French: uses a custom algorithm

French implementation
===

| Root sound  | Pattern                      | Replacement | Example          |
| ----------- | -----------------------      | ----------- | -----------      |
| 3           | è                            | 3           | très             |
| 3           | é                            | 3           | était            |
| 3           | ai                           | 3           | était            |
| 3           | e[rt]$                       | 3           | est rentrer      /
| 3           | ^est$                        | 3           | est rentrer      /
| 3           | e[rt] following letter kept  | 3           | errance          /
| 3           | es[^$] following letter kep  | 3           | brest            /
| 3           | ez$                          | 3           | est rentrer      /
| a           | a                            | a           | abracadra        |
| a           | oi                           | a           | oie              |
| b           | b                            | b           | abolition        |
| b           | p                            | b           | problème         |
| 1           | in                           | 1           | obtint           |
| 1           | un                           | 1           | emprunt          |
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
| e           | oeu                          | e           | oeuvre           |
| e           | oe                           | e           | oedême           |
| 2           | o[nm][^aeiouy]               | 2           | attention ombre  |
| z           | z                            | z           | hasard           |
| j           | j                            | j           | juger            |
| j           | g[ei]                        | j           | juger gironde    |
| j           | ch                           | j           | chercher         |
| j           | sh                           | j           | sherpa           |
| z           | [aeiouy]s[aeiouy]            | z           | hasard           |
| i           | ill                          | i           | briller          |
| i           | i                            | i           | cession          |
| i           | y                            | i           | cession          |
| g           | g[^ei]                       | g           | gué gardien      |
| s           | s                            | s           | sérieux          |
| s           | c[ei]                        | s           | cession          |
| s           | ç                            | s           | ça               |
| k           | k                            | k           | karaté           |
| k           | c                            | k           | caramel          |
| k           | qu                           | k           | que              |
| u           | ou                           | u           | oublie           |
| u           | u                            | u           | ubuesque         |
| -           | [deqrstwxz]$                 | -           | oedêm**e**       |
| -           | p$ after [aeiouy123]         | -           | camp             |
| -           | e                            | -           | oedême aiment    |
| -           | h                            | -           | habituer         |


0. Remove numbers and work in lower case.
1. Proceed with substitution in the given order.
2. Remove duplicates
3. Remove `-`
4. If wished remove `aeiouy123`

