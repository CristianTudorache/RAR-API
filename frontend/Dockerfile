FROM node:18

WORKDIR /app

COPY package*.json ./

ENV ROLLUP_NO_NATIVE=true

RUN npm cache clean --force

RUN npm ci


# Acordam permisiunile necesare pentru vite
RUN chmod -R 755 node_modules

COPY . .

EXPOSE 5173

CMD ["npm", "run", "dev", "--", "--host"]