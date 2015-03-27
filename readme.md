BMAIL
-----

Send a birthday reminder via e-mail to receivers.

## step by step (oh baby)

1. Put a file like this to src/bmails.json

```javascript
{
  "bmails": [
    {
      "kind": "birthday",
      "receivers": [
        "receiver.one@example.com",
        "receiver.two@example.com",
        "receiver.three@example.com"
      ],
      "events": [
        {"name":"Joe Bloggs","date":"2006-02-05"},
        {"name":"John Smith","date":"1971-11-26"}
      ]
    },{
      "kind": "birthday",
      "receivers": [
        "receiver.four@example.com"
      ],
      "events": [
        {"name":"Peter B.","date":"2041-12-24"},
        {"name":"Gina W.","date":"1921-11-30"}
      ]
    }
  ]
}
```
2. create a crontab like

    0 2 * * * php /path/to/index.php
    
3. ensure, php is able to send mails

## what for?!

receivers one, two, three will get an e-mail reminder on 5.2. and 26.11., receiver four will get an reminder on 24.12. and 30.11.

## ant

the ant task is not needed. If you have an ssh connection to your server, you can define the connection in build-my.properties and you can use the deploy task then.