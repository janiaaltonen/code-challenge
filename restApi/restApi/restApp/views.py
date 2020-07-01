from .api.serializers import ClientMovieSerializer, ClientBookSerializer
from rest_framework.views import APIView
from rest_framework.response import Response
import requests


class MovieView(APIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.api_url = "http://www.omdbapi.com/?apikey=8d80385a"

    def get(self, request):
        input_params = ClientMovieSerializer(data=request.query_params)
        input_params.is_valid()
        for key, value in input_params.validated_data.items():
            self.api_url += "&" + key + "=" + str(value)
        response_data = requests.get(self.api_url).json()
        if len(response_data) <= 2:
            value = 'Movie not found with title ' + input_params.validated_data['t']
            response_data = {'Result': value}
        return Response(data=response_data)


class BookView(APIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.api_url = "https://openlibrary.org/api/books?"

    def get(self, request):
        input_params = ClientBookSerializer(data=request.query_params)
        input_params.is_valid()
        for key, value in input_params.validated_data.items():
            if key == 'bibkeys':
                self.api_url += key + "=ISBN:" + value
        self.api_url += "&format=json&jscmd=data"
        response_data = requests.get(self.api_url).json()
        if len(response_data) < 1:
            response_data = {'Result:': 'Book not found with ISBN ' + input_params.validated_data['bibkeys']}
        return Response(data=response_data)