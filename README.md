# Learning RabbitMQ with PHP

### Run your RMQ container
- docker-compose -f docker-compose-rmq.yaml up -d

### Run your app container
- docker-compose -f docker-compose-app.yaml up -d

### Listen to events
- docker exec -it app bash && cd public && php q-update-inventory.php

### Trigger an event
- docker exec -it app bash && cd public && php action-sale.php
- docker exec -it app bash && cd public && php action-delivery.php