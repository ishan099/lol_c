# lol_c

"D:\sofrtware\Implementer Software\chrome32_54.0.2840.71\chrome.exe" --unsafely-treat-insecure-origin-as-secure=http://console.facetone.lk --user-data-dir="D:\sofrtware\Implementer Software\chrome32_54.0.2840.71\new"


docker run -d -t --memory="512m" -v /etc/localtime:/etc/localtime:ro -v $FILE_DIRECTORY_PATH_LOCAL:$FILE_DIRECTORY_PATH --env="SYS_FILE_BASEPATH=$FILE_DIRECTORY_PATH" --env="VERSION_TAG=$VERSION_TAG" --env="COMPOSE_DATE=$DATE" --env="STORAGE_OPTION=$FILE_STORAGE" --env="NODE_CONFIG_DIR=/usr/local/src/fileservice/config" --env="HOST_TOKEN=$HOST_TOKEN" --env="HOST_FILESERVICE_PORT=8812" --env="HOST_VERSION=$HOST_VERSION" --env="SYS_DATABASE_HOST=$DATABASE_HOST" --env="SYS_DATABASE_TYPE=$DATABASE_TYPE" --env="SYS_DATABASE_POSTGRES_USER=$DATABASE_POSTGRES_USER" --env="SYS_DATABASE_POSTGRES_PASSWORD=$DATABASE_POSTGRES_PASSWORD" --env="SYS_SQL_PORT=$SQL_PORT" --env="SYS_REDIS_HOST=$REDIS_HOST" --env="SYS_REDIS_PASSWORD=$REDIS_PASSWORD" --env="SYS_REDIS_PORT=$REDIS_PORT" --env="SYS_REDIS_MODE=$REDIS_MODE" --env="SYS_REDIS_SENTINEL_HOSTS=$REDIS_SENTINEL_HOSTS" --env="SYS_REDIS_SENTINEL_PORT=$REDIS_SENTINEL_PORT" --env="SYS_REDIS_SENTINEL_NAME=$REDIS_SENTINEL_NAME" --env="SYS_MONGO_HOST=$MONGO_HOST" --env="SYS_MONGO_USER=$MONGO_USER" --env="SYS_MONGO_PASSWORD=$MONGO_PASSWORD" --env="SYS_MONGO_DB=$MONGO_DB" --env="SYS_MONGO_PORT=$MONGO_PORT" --env="SYS_MONGO_REPLICASETNAME=$MONGO_REPLICA_SET_NAME" --env="SYS_RABBITMQ_HOST=$RABBITMQ_HOST" --env="SYS_RABBITMQ_PORT=$RABBITMQ_PORT" --env="SYS_RABBITMQ_USER=$RABBITMQ_USER" --env="SYS_RABBITMQ_PASSWORD=$RABBITMQ_PASSWORD" --env="SYS_COUCH_HOST=$COUCH_HOST" --env="SYS_COUCH_PORT=$COUCH_PORT" --env="VIRTUAL_HOST=fileservice.*" --env="LB_FRONTEND=fileservice.$FRONTEND" --env="LB_PORT=$LB_PORT" --env="CRYPTO_ALGO=$CRYPTO_ALGO" --env="CRYPTO_PASSWORD=$CRYPTO_PASSWORD" --expose=8812/tcp --log-opt max-size=10m --log-opt max-file=10 --restart=always --name fileservice fileservice:$VERSION_TAG node /usr/local/src/fileservice/app.js;
