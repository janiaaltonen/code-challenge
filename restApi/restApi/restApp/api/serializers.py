from rest_framework import serializers


class ClientMovieSerializer(serializers.Serializer):
    t = serializers.CharField()
    y = serializers.IntegerField(allow_null=True, required=False)
    plot = serializers.CharField(allow_null=True, required=False)


#class MovieSerializer(serializers.Serializer):
#    if response from OMDB needs to be modified then write this serializer


class ClientBookSerializer(serializers.Serializer):
    bibkeys = serializers.CharField()
