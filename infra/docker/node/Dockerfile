FROM node:23-alpine3.20

RUN apk update && apk upgrade
RUN apk add --no-cache make gcc g++ python3

WORKDIR /var/www/app

ENTRYPOINT ["npm", "run", "dev"]
