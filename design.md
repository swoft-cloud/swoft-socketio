# design


```text
                   swoft ws server
                          |
            +--------------------------------+
            |                                |
        echo server                          |
(path /echo, namespace /echo)                |
                                        chat server
                                (path /chat, namespace /chat)  
                                             |
                               -------------------
                               |      |       |      ......
                            room 1  room 2  room 3   ......             
```
